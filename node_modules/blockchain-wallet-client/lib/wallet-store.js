'use strict';

var MyWallet = require('./wallet');
var WalletCrypto = require('./wallet-crypto');

var WalletStore = function () {
  var password; // Password
  var guid; // Wallet identifier
  var language = 'en';
  var pbkdf2Iterations = 5000; // pbkdf2_interations of the main password (to encrypt the full payload)
  var _disableLogout = false;
  var realAuthType = 0; // The real two factor authentication. Even if there is a problem with the current one (for example error 2FA sending email).
  var encryptedWalletData; // Encrypted wallet data (Base64, AES 256)
  var payloadChecksum; // SHA256 hash of the current wallet.aes.json
  var _isPolling = false;
  var _isRestoringWallet = false;
  var counter = 0;
  var syncPubkeys = false;
  var _isSynchronizedWithServer = true;
  var eventListeners = [];

  return {
    setPbkdf2Iterations: function setPbkdf2Iterations(iterations) {
      pbkdf2Iterations = iterations;
      return;
    },
    getPbkdf2Iterations: function getPbkdf2Iterations() {
      return pbkdf2Iterations;
    },
    getLanguage: function getLanguage() {
      return language;
    },
    setLanguage: function setLanguage(lan) {
      language = lan;
    },
    disableLogout: function disableLogout() {
      _disableLogout = true;
    },
    enableLogout: function enableLogout() {
      _disableLogout = false;
    },
    isLogoutDisabled: function isLogoutDisabled() {
      return _disableLogout;
    },
    setRealAuthType: function setRealAuthType(number) {
      realAuthType = number;
    },
    get2FAType: function get2FAType() {
      return realAuthType;
    },
    get2FATypeString: function get2FATypeString() {
      var stringType = '';
      switch (realAuthType) {
        case 0:
          stringType = null;break;
        case 1:
          stringType = 'Yubikey';break;
        case 2:
          stringType = 'Email';break;
        case 3:
          stringType = 'Yubikey MtGox - Unsupported';break;
        case 4:
          stringType = 'Google Auth';break;
        case 5:
          stringType = 'SMS';break;
        default:
          stringType = null;break;
      }
      return stringType;
    },
    getGuid: function getGuid() {
      return guid;
    },
    setGuid: function setGuid(stringValue) {
      guid = stringValue;
    },
    generatePayloadChecksum: function generatePayloadChecksum() {
      return WalletCrypto.sha256(encryptedWalletData).toString('hex');
    },
    setEncryptedWalletData: function setEncryptedWalletData(data) {
      if (!data || data.length === 0) {
        encryptedWalletData = null;
        payloadChecksum = null;
      } else {
        encryptedWalletData = data;
        payloadChecksum = this.generatePayloadChecksum();
      }
    },
    getEncryptedWalletData: function getEncryptedWalletData() {
      return encryptedWalletData;
    },
    getPayloadChecksum: function getPayloadChecksum() {
      return payloadChecksum;
    },
    setPayloadChecksum: function setPayloadChecksum(value) {
      payloadChecksum = value;
    },
    isPolling: function isPolling() {
      return _isPolling;
    },
    setIsPolling: function setIsPolling(bool) {
      _isPolling = bool;
    },
    isRestoringWallet: function isRestoringWallet() {
      return _isRestoringWallet;
    },
    setRestoringWallet: function setRestoringWallet(bool) {
      _isRestoringWallet = bool;
    },
    incrementCounter: function incrementCounter() {
      counter = counter + 1;
    },
    getCounter: function getCounter() {
      return counter;
    },
    setSyncPubKeys: function setSyncPubKeys(bool) {
      syncPubkeys = bool;
    },
    isSyncPubKeys: function isSyncPubKeys() {
      return syncPubkeys;
    },
    isSynchronizedWithServer: function isSynchronizedWithServer() {
      return _isSynchronizedWithServer;
    },
    setIsSynchronizedWithServer: function setIsSynchronizedWithServer(bool) {
      _isSynchronizedWithServer = bool;
    },
    addEventListener: function addEventListener(func) {
      eventListeners.push(func);
    },
    sendEvent: function sendEvent(eventName, obj) {
      for (var listener in eventListeners) {
        eventListeners[listener](eventName, obj);
      }
    },
    isCorrectMainPassword: function isCorrectMainPassword(candidate) {
      return password === candidate;
    },
    changePassword: function changePassword(newPassword, success, error) {
      password = newPassword;
      MyWallet.syncWallet(success, error);
    },
    unsafeSetPassword: function unsafeSetPassword(newPassword) {
      password = newPassword;
    },
    getPassword: function getPassword() {
      return password;
    },
    getLogoutTime: function getLogoutTime() {
      return MyWallet.wallet._logoutTime;
    },
    setLogoutTime: function setLogoutTime(logoutTime) {
      MyWallet.wallet.logoutTime = logoutTime;
    }
  };
}();

module.exports = WalletStore;