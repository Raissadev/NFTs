var Exchange = require('bitcoin-exchange-client');
var PaymentMethod = require('./payment-medium');
var Trade = require('./trade');

var { toCents, toSatoshi } = Exchange.Helpers;
var isBTC = (c) => c === 'BTC';
var flipCurrency = (c) => isBTC(c) ? 'USD' : 'BTC';

class Quote extends Exchange.Quote {
  constructor (obj, baseCurrency, api, delegate, debug) {
    super(api, delegate, Trade, PaymentMethod, debug);

    var expiresAt = new Date(obj.expires_on);
    var timeOfRequest = new Date(obj.current_time);
    var btcAmount = toSatoshi(obj.base_amount);
    var usdAmount = toCents(obj.quote_amount);

    this._id = obj.quote_id;
    this._expiresAt = expiresAt;
    this._timeOfRequest = timeOfRequest;
    this._rate = obj.rate;

    this._baseCurrency = baseCurrency.toUpperCase();
    this._baseAmount = isBTC(this._baseCurrency) ? btcAmount : usdAmount;

    this._quoteCurrency = flipCurrency(this._baseCurrency);
    this._quoteAmount = isBTC(this._quoteCurrency) ? btcAmount : usdAmount;

    this._feeAmount = toCents(obj.fee_amount);
    this._feeCurrency = obj.fee_currency.toUpperCase();
  }

  get rate () {
    return this._rate;
  }

  static getQuote (api, delegate, amount, baseCurrency, quoteCurrency, debug) {
    const processQuote = (quote) => {
      let q = new Quote(quote, baseCurrency, api, delegate);
      q.debug = debug;
      return q;
    };

    const getQuote = (_baseAmount) => {
      let action = _baseAmount < 0 ? 'buy' : 'sell';

      return api.POST('quote/', {
        action: action,
        base_currency: 'btc',
        quote_currency: 'usd',
        amount: Math.abs(_baseAmount),
        amount_currency: baseCurrency.toLowerCase()
      }, 'v1', 'quotes');
    };

    return super
      .getQuote(-amount, baseCurrency, quoteCurrency, ['BTC', 'EUR', 'GBP', 'USD', 'DKK'], debug)
      .then(getQuote)
      .then(processQuote);
  }
}

module.exports = Quote;
