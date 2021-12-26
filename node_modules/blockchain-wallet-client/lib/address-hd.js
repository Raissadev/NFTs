'use strict';

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

var Helpers = require('./helpers');

var assert = require('assert');

var AddressHD = function () {
  function AddressHD(object, account, index) {
    _classCallCheck(this, AddressHD);

    assert(object || object === null, 'Data (or null) missing');
    assert(account.constructor.name === 'HDAccount', 'HDAccount missing');
    assert(Helpers.isPositiveInteger(index), 'Receive index missing');

    this._account = account;
    this._index = index;
    if (object === null) {
      this._label = null;
    } else {
      this._label = object.label;
    }
    this._used = null;
    this._balance = null;
    this._address = undefined;
  }

  _createClass(AddressHD, [{
    key: 'toJSON',
    value: function toJSON() {
      if (this._label === null) return null;
      return {
        label: this._label
      };
    }
  }, {
    key: 'address',
    get: function get() {
      if (!this._address) {
        this._address = this._account.receiveAddressAtIndex(this._index);
      }
      return this._address;
    }
  }, {
    key: 'index',
    get: function get() {
      return this._index;
    }
  }, {
    key: 'label',
    get: function get() {
      return this._label;
    },
    set: function set(value) {
      this._label = value;
    }
  }, {
    key: 'balance',
    get: function get() {
      return this._balance;
    },
    set: function set(value) {
      this._balance = value;
    }
  }, {
    key: 'used',
    get: function get() {
      return this._used;
    },
    set: function set(value) {
      this._used = value;
    }
  }]);

  return AddressHD;
}();

module.exports = AddressHD;