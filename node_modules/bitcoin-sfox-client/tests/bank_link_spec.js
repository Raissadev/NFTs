let proxyquire = require('proxyquireify')(require);

let stubs = {
};

let BankLink = proxyquire('../src/bank-link', stubs);

BankLink.getAccounts = () => Promise.resolve([{}]);
BankLink.setAccount = (obj) => Promise.resolve([{}]);

let b;
let bl;
let api;
let obj;

beforeEach(function () {
  api = {};
  b = {
    'institution_type': 'fake_institution',
    'meta': {
      'name': 'Plaid Savings',
      'number': '9606'
    },
    'balance': {
      'current': 1274.93,
      'available': 1203.42
    }
  }
  obj = {
    firstName: 'Banky',
    lastName: 'McBankface',
    token: '12345',
    id: '123'
  }
  return JasminePromiseMatchers.install();
});

afterEach(() => JasminePromiseMatchers.uninstall());

describe('SFOX Bank Link', function () {
  beforeEach(function () {
    api = {
      authPOST (method, params) {
        return Promise.resolve([b]);
      }
    };

    bl = new BankLink(api);
    spyOn(api, 'authPOST').and.callThrough();
  });

  describe('getAccounts', function () {
    it('should return a list of bank accounts', function () {
      spyOn(bl, 'getAccounts').and.callThrough();
      let promise = bl.getAccounts('12345');
      let testCalls = () =>

      expect(bl.getAccounts).toHaveBeenCalled();

      return promise.then(testCalls);
    })
  });

  describe('setAccount', function () {
    it('should set an account', function () {
      spyOn(bl, 'setAccount').and.callThrough();
      let promise = bl.setAccount(obj);
      let testCalls = () =>

      expect(bl.setAccount).toHaveBeenCalled();

      return promise.then(testCalls);
    });
  });
});
