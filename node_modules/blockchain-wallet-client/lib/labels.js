'use strict';

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

var Helpers = require('./helpers');
var AddressHD = require('./address-hd');
var BlockchainAPI = require('./api');

var assert = require('assert');

var Labels = function () {
  function Labels(wallet, syncWallet) {
    _classCallCheck(this, Labels);

    assert(syncWallet instanceof Function, 'syncWallet function required');
    this._wallet = wallet;

    this._syncWallet = function () {
      return new Promise(syncWallet);
    };

    this.init();
  }

  _createClass(Labels, [{
    key: 'init',
    value: function init() {
      this._accounts = [];

      var _iteratorNormalCompletion = true;
      var _didIteratorError = false;
      var _iteratorError = undefined;

      try {
        for (var _iterator = this._wallet.hdwallet.accounts[Symbol.iterator](), _step; !(_iteratorNormalCompletion = (_step = _iterator.next()).done); _iteratorNormalCompletion = true) {
          var hdAccount = _step.value;

          var accountIndex = hdAccount.index;
          var receiveIndex = hdAccount.receiveIndex;
          var addresses = [];

          var _iteratorNormalCompletion2 = true;
          var _didIteratorError2 = false;
          var _iteratorError2 = undefined;

          try {
            for (var _iterator2 = hdAccount.getLabels()[Symbol.iterator](), _step2; !(_iteratorNormalCompletion2 = (_step2 = _iterator2.next()).done); _iteratorNormalCompletion2 = true) {
              var addressLabel = _step2.value;

              addresses[addressLabel.index] = new AddressHD({
                label: addressLabel.label
              }, hdAccount, addressLabel.index);
            }

            // Add null entries up to the current (labeled) receive index
          } catch (err) {
            _didIteratorError2 = true;
            _iteratorError2 = err;
          } finally {
            try {
              if (!_iteratorNormalCompletion2 && _iterator2.return) {
                _iterator2.return();
              }
            } finally {
              if (_didIteratorError2) {
                throw _iteratorError2;
              }
            }
          }

          for (var i = 0; i < Math.max(receiveIndex + 1, addresses.length); i++) {
            if (!addresses[i]) {
              addresses[i] = new AddressHD(null, hdAccount, i);
            }
          }
          this._accounts[accountIndex] = addresses;
        }
      } catch (err) {
        _didIteratorError = true;
        _iteratorError = err;
      } finally {
        try {
          if (!_iteratorNormalCompletion && _iterator.return) {
            _iterator.return();
          }
        } finally {
          if (_didIteratorError) {
            throw _iteratorError;
          }
        }
      }
    }
  }, {
    key: 'toJSON',


    // For debugging only, not used to save.
    value: function toJSON() {
      return {
        version: this.version,
        accounts: this._accounts.map(function (addresses) {
          if (addresses.length > 1) {
            addresses = Helpers.deepClone(addresses);
            // Remove trailing null values:
            while (!addresses[addresses.length - 1] || addresses[addresses.length - 1].label === null) {
              addresses.pop();
            }
          }
          return addresses;
        })
      };
    }

    // Goes through all labeled addresses and checks which ones have transactions.
    // This result will be cached in the future. Although we obtain the balance,
    // this is an implementation detail and we don't save it.

  }, {
    key: 'checkIfUsed',
    value: function checkIfUsed(accountIndex) {
      assert(Helpers.isPositiveInteger(accountIndex), 'specify accountIndex');
      var labeledAddresses = this.all(accountIndex).filter(function (a) {
        return a !== null && a.label !== null;
      });
      var addresses = labeledAddresses.map(function (a) {
        return a.address;
      });
      if (addresses.length === 0) return Promise.resolve();

      return BlockchainAPI.getBalances(addresses).then(function (data) {
        var _iteratorNormalCompletion3 = true;
        var _didIteratorError3 = false;
        var _iteratorError3 = undefined;

        try {
          for (var _iterator3 = labeledAddresses[Symbol.iterator](), _step3; !(_iteratorNormalCompletion3 = (_step3 = _iterator3.next()).done); _iteratorNormalCompletion3 = true) {
            var labeledAddress = _step3.value;

            if (data[labeledAddress.address]) {
              labeledAddress.used = data[labeledAddress.address].n_tx > 0;
            }
          }
        } catch (err) {
          _didIteratorError3 = true;
          _iteratorError3 = err;
        } finally {
          try {
            if (!_iteratorNormalCompletion3 && _iterator3.return) {
              _iterator3.return();
            }
          } finally {
            if (_didIteratorError3) {
              throw _iteratorError3;
            }
          }
        }
      });
    }
  }, {
    key: 'fetchBalance',
    value: function fetchBalance(hdAddresses) {
      assert(Array.isArray(hdAddresses), 'hdAddresses missing');
      var _iteratorNormalCompletion4 = true;
      var _didIteratorError4 = false;
      var _iteratorError4 = undefined;

      try {
        for (var _iterator4 = hdAddresses[Symbol.iterator](), _step4; !(_iteratorNormalCompletion4 = (_step4 = _iterator4.next()).done); _iteratorNormalCompletion4 = true) {
          var addressHD = _step4.value;

          assert(addressHD.constructor.name === 'AddressHD', 'AddressHD required');
        }
      } catch (err) {
        _didIteratorError4 = true;
        _iteratorError4 = err;
      } finally {
        try {
          if (!_iteratorNormalCompletion4 && _iterator4.return) {
            _iterator4.return();
          }
        } finally {
          if (_didIteratorError4) {
            throw _iteratorError4;
          }
        }
      }

      var addresses = hdAddresses.filter(function (a) {
        return a.balance === null;
      }).map(function (a) {
        return a.address;
      });

      if (addresses.length === 0) return Promise.resolve();

      return BlockchainAPI.getBalances(addresses).then(function (data) {
        var _iteratorNormalCompletion5 = true;
        var _didIteratorError5 = false;
        var _iteratorError5 = undefined;

        try {
          for (var _iterator5 = hdAddresses[Symbol.iterator](), _step5; !(_iteratorNormalCompletion5 = (_step5 = _iterator5.next()).done); _iteratorNormalCompletion5 = true) {
            var a = _step5.value;

            if (data[a.address]) {
              a.used = data[a.address].n_tx > 0;
              a.balance = data[a.address].final_balance;
            }
          }
        } catch (err) {
          _didIteratorError5 = true;
          _iteratorError5 = err;
        } finally {
          try {
            if (!_iteratorNormalCompletion5 && _iterator5.return) {
              _iterator5.return();
            }
          } finally {
            if (_didIteratorError5) {
              throw _iteratorError5;
            }
          }
        }
      });
    }
  }, {
    key: 'all',
    value: function all(accountIndex) {
      var options = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : {};

      return this._getAccount(accountIndex);
    }

    // Side-effect: adds empty array to this._accounts if needed

  }, {
    key: '_getAccount',
    value: function _getAccount(accountIndex) {
      assert(Helpers.isPositiveInteger(accountIndex), 'specify accountIndex');
      if (!this._accounts[accountIndex]) {
        assert(this._wallet.hdwallet.accounts[accountIndex], 'Wallet does not contain account', accountIndex);
        this._accounts[accountIndex] = [];
      }
      return this._accounts[accountIndex];
    }

    // returns Int or null

  }, {
    key: 'maxLabeledReceiveIndex',
    value: function maxLabeledReceiveIndex(accountIndex) {
      var labeledAddresses = this._getAccount(accountIndex).filter(function (a) {
        return a && a.label !== null;
      });
      if (labeledAddresses.length === 0) return null;
      var indexOf = labeledAddresses[labeledAddresses.length - 1].index;
      return indexOf > -1 ? indexOf : null;
    }

    // Side-effect: adds a new entry if there is a new account or receive index.

  }, {
    key: 'getAddress',
    value: function getAddress(accountIndex, receiveIndex) {
      var entry = this._getAccount(accountIndex)[receiveIndex];

      if (!entry) {
        entry = new AddressHD(null, this._wallet.hdwallet.accounts[accountIndex], receiveIndex);
        entry.used = null;
        this._getAccount(accountIndex)[receiveIndex] = entry;
      }

      return entry;
    }
  }, {
    key: 'getLabel',
    value: function getLabel(accountIndex, addressIndex) {
      var entry = this.getAddress(accountIndex, addressIndex);
      return entry.label;
    }
  }, {
    key: 'addLabel',
    value: function addLabel(accountIndex, maxGap, label) {
      assert(Helpers.isPositiveInteger(accountIndex), 'specify accountIndex');
      assert(Helpers.isString(label), 'specify label');
      assert(Helpers.isPositiveInteger(maxGap) && maxGap <= 20, 'Max gap must be less than 20');

      var receiveIndex = this._wallet.hdwallet.accounts[accountIndex].receiveIndex;
      var lastUsedReceiveIndex = this._wallet.hdwallet.accounts[accountIndex].lastUsedReceiveIndex;

      if (!Helpers.isValidLabel(label)) {
        return Promise.reject('NOT_ALPHANUMERIC');
      } else if (receiveIndex - lastUsedReceiveIndex >= maxGap) {
        // Exceeds BIP 44 unused address gap limit
        return Promise.reject('GAP');
      }

      var addr = this.getAddress(accountIndex, receiveIndex);

      addr.label = label;
      addr.used = false;

      // Update wallet:
      this._wallet.hdwallet.accounts[accountIndex].addLabel(receiveIndex, label);

      return this._syncWallet().then(function () {
        return addr;
      });
    }

    // address: either an AddressHD object or a receive index Integer

  }, {
    key: 'setLabel',
    value: function setLabel(accountIndex, address, label) {
      assert(Helpers.isPositiveInteger(address) || address.constructor && address.constructor.name === 'AddressHD', 'address should be AddressHD instance or Int');

      var receiveIndex = void 0;

      if (Helpers.isPositiveInteger(address)) {
        receiveIndex = address;
        address = this.getAddress(accountIndex, receiveIndex);
      } else {
        receiveIndex = this._getAccount(accountIndex).indexOf(address);
        assert(Helpers.isPositiveInteger(receiveIndex), 'Address not found');
      }

      if (!Helpers.isValidLabel(label)) {
        return Promise.reject('NOT_ALPHANUMERIC');
      }

      if (address.label === label) {
        return Promise.resolve();
      }

      address.label = label;

      // Update in wallet:
      this._wallet.hdwallet.accounts[accountIndex].setLabel(receiveIndex, label);

      return this._syncWallet();
    }
  }, {
    key: 'removeLabel',
    value: function removeLabel(accountIndex, address) {
      assert(Helpers.isPositiveInteger(accountIndex), 'Account index required');

      assert(Helpers.isPositiveInteger(address) || address.constructor && address.constructor.name === 'AddressHD', 'address should be AddressHD instance or Int');

      var addressIndex = void 0;
      if (Helpers.isPositiveInteger(address)) {
        addressIndex = address;
        address = this._getAccount(accountIndex)[address];
      } else {
        addressIndex = this._getAccount(accountIndex).indexOf(address);
        assert(Helpers.isPositiveInteger(addressIndex), 'Address not found');
      }

      address.label = null;

      // Remove from wallet:
      this._wallet.hdwallet.accounts[accountIndex].removeLabel(addressIndex);

      return this._syncWallet();
    }

    // options:
    //   Int || null reusableIndex: allow reuse in case of the gap limit

  }, {
    key: 'reserveReceiveAddress',
    value: function reserveReceiveAddress(accountIndex) {
      var options = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : {};

      assert(Helpers.isPositiveInteger(accountIndex), 'Account index required');
      if (options.reusableIndex !== undefined) {
        assert(options.reusableIndex === null || Helpers.isPositiveInteger(options.reusableIndex), 'not an integer');
      }

      var self = this;
      var account = this._wallet.hdwallet.accounts[accountIndex];

      var receiveIndex = account.receiveIndex;
      var originalLabel; // In case of address reuse

      // Respect the GAP limit:
      if (receiveIndex - account.lastUsedReceiveIndex >= 20) {
        receiveIndex = options.reusableIndex;
        if (receiveIndex == null) throw new Error('gap_limit');
        originalLabel = this.getLabel(accountIndex, receiveIndex);
      }

      var receiveAddress = account.receiveAddressAtIndex(receiveIndex);

      //   String label: will be appended in case of reuse
      function commitAddressLabel() {
        var label = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : '';

        if (originalLabel) label = originalLabel + ', ' + label;

        self.setLabel(accountIndex, receiveIndex, label);
      }

      return {
        receiveIndex: receiveIndex,
        receiveAddress: receiveAddress,
        commit: commitAddressLabel
      };
    }
  }, {
    key: 'releaseReceiveAddress',
    value: function releaseReceiveAddress(accountIndex, receiveIndex) {
      var options = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : {};

      assert(Helpers.isPositiveInteger(accountIndex), 'Account index required');
      assert(Helpers.isPositiveInteger(receiveIndex), 'Receive index required');

      if (options.expectedLabel !== undefined) {
        assert(options.expectedLabel === null || Helpers.isString(options.expectedLabel), 'not a string');
      }

      var address = this.getAddress(accountIndex, receiveIndex);

      if (options.expectedLabel) {
        if (address.label.includes(options.expectedLabel)) {
          var firstEntry = address.label.indexOf(options.expectedLabel) === 0;
          this.setLabel(accountIndex, address, firstEntry ? address.label.replace(options.expectedLabel + ', ', '') : address.label.replace(', ' + options.expectedLabel, ''));
        } else {
          // Don't touch the label
        }
      } else {
        // Remove label
        this.removeLabel(accountIndex, address);
      }
    }
  }, {
    key: 'readOnly',
    get: function get() {
      return false;
    }
  }]);

  return Labels;
}();

module.exports = Labels;