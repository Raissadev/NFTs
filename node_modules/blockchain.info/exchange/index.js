'use strict';

var API         = require('../api')
  , UrlPattern  = require('url-pattern');

var endpoints  = {
  ticker  : new UrlPattern('/ticker(?api_code=:apiCode)'),
  tobtc   : new UrlPattern('/tobtc?value=:value&currency=:currency(&api_code=:apiCode)')
};

var api = new API('https://blockchain.info', endpoints);

module.exports = {
  getTicker : getTicker,
  toBTC     : toBTC
};

function getTicker(options) {
  options = options || {};
  return api.request('ticker', { apiCode: options.apiCode })
    .then(function (data) { return data[options.currency] || data; });
}

function toBTC(amount, currency, options) {
  options = options || {};
  return api.request('tobtc', { value: amount, currency: currency, apiCode: options.apiCode })
    .then(function (amount) { return amount.replace(',', ''); });
}
