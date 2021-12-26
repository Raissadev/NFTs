let proxyquire = require('proxyquireify')(require);

let stubs = {
};

let PaymentAccount = proxyquire('../src/payment-account', stubs);
let o;
let b;
let api;
let quote;

beforeEach(function () {
  api = {};
  o = {
    payment_method_id: '1234',
    type: 'ach',
    status: 'active',
    routing_number: '**89',
    account_number: '**67',
    nickname: 'checking 1',
    currency: 'usd'
  };
  return JasminePromiseMatchers.install();
});

afterEach(() => JasminePromiseMatchers.uninstall());

describe('SFOX Payment Account', function () {
  describe('constructor', function () {
    quote = undefined;

    beforeEach(() => {
      quote = {baseAmount: -1000};
    });

    it('should deserialize JSON', function () {
      b = new PaymentAccount(o, api, quote);
      expect(b._id).toEqual(o.payment_method_id);
      expect(b._status).toEqual(o.status);
      expect(b._routingNumber).toEqual(o.routing_number);
      expect(b._accountNumber).toEqual(o.account_number);
      expect(b._name).toEqual(o.nickname);
    });
  });

  describe('getAll', () =>
    it('should authGET payment-methods', function (done) {
      api = {
        authGET (method, params) {
          return Promise.resolve([o]);
        }
      };
      spyOn(api, 'authGET').and.callThrough();

      let promise = PaymentAccount.getAll('USD', 'BTC', api, quote);
      let testCalls = () =>
      expect(api.authGET).toHaveBeenCalledWith('payment-methods');

      return promise
        .then(testCalls)
        .then(done);
    })
  );
});
