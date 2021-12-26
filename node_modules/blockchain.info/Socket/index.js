'use strict';

try {
  var WebSocket = require('ws');
} catch (e) {
  return module.exports = function () {
    console.log('Cannot create Socket object, module `ws` was not installed correctly');
  };
}

function Socket() {
  var wsUrl   = 'wss://ws.blockchain.info/inv';
  this.socket = new WebSocket(wsUrl);
  this.subs   = [];
}

Socket.prototype.subscribe = function (sub, options) {
  var hasSub = this.subs.some(function (s) { return s === sub; });
  if (hasSub) return;
  var message = extend({ op: sub }, options || {});
  this.socket.on('open', function () {
    this.send(JSON.stringify(message));
  }.bind(this.socket));
  return this;
};

Socket.prototype.onOpen = function (callback) {
  this.socket.on('open', callback);
  return this;
};

Socket.prototype.onClose = function (callback) {
  this.socket.on('close', callback);
  return this;
};

Socket.prototype.onTransaction = function (callback, options) {
  options = options || {};
  if (options.addresses instanceof Array) {
    options.addresses.forEach(function (addr) {
      this.subscribe('addr_sub', { addr: addr });
    }.bind(this));
  } else {
    this.subscribe('unconfirmed_sub');
  }
  if (options.setTxMini) {
    this.subscribe('set_tx_mini');
  }
  this.socket.on('message', function (msg) {
    msg = parseJSON(msg);
    if (msg.op === 'utx' || msg.op === 'minitx') callback(msg.x);
  });
  return this;
};

Socket.prototype.onBlock = function (callback) {
  this.subscribe('blocks_sub');
  this.socket.on('message', function (msg) {
    msg = parseJSON(msg);
    if (msg.op === 'block') callback(msg.x);
  });
  return this;
};

module.exports = Socket;

// Helper functions
function extend(o, p) {
  for (var prop in p) {
    if (!o.hasOwnProperty(prop)) {
      o[prop] = p[prop];
    }
  }
  return o;
}

function parseJSON(j) {
  try       { return JSON.parse(j); }
  catch (e) { return j;             };
}
