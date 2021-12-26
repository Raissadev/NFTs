let proxyquire = require('proxyquireify')(require);

const API = () =>
  ({
    GET () {},
    POST () {},
    PATCH () {}
  })
;

let Exchange = {
  API
};

let ExchangeDelegate = () =>
  ({
    save () { return Promise.resolve(); }
  })
;

let Profile = function () {};

Profile.fetch = () => Promise.resolve({mock: 'profile'});

let Trade = obj => obj;
Trade.spyableProcessTrade = function () {};
let tradesJSON = [
  {
    id: 1,
    state: 'completed'
  }
];
Trade.fetchAll = () =>
  Promise.resolve([
    {
      id: tradesJSON[0].id,
      state: tradesJSON[0].state,
      process: Trade.spyableProcessTrade
    }
  ])
;
Trade.monitorPayments = function () {};
Trade.buy = quote => Promise.resolve({amount: quote.baseAmount});

let stubs = {
  'bitcoin-exchange-client': Exchange,
  '../exchange-delegate': ExchangeDelegate,
  './profile': Profile,
  './trade': Trade
};

const SFOX = proxyquire('../src/sfox', stubs);

describe('SFOX', function () {
  let s;

  beforeEach(() => JasminePromiseMatchers.install());

  afterEach(() => JasminePromiseMatchers.uninstall());

  describe('class', function () {
    describe('new SFOX()', function () {
      it('should transform an Object to a SFOX', function () {
        s = new SFOX({auto_login: true}, {});
        expect(s.constructor.name).toEqual('SFOX');
      });

      it('should use fields', function () {
        s = new SFOX({auto_login: true}, {});
        expect(s._auto_login).toEqual(true);
      });

      it('should require a delegate', () =>
      expect(() => new SFOX({auto_login: true})).toThrow());

      it('should deserialize trades', function () {
        s = new SFOX({
          auto_login: true,
          trades: [{}]
        }, {});
        expect(s.trades.length).toEqual(1);
      });
    });

    describe('SFOX.new()', function () {
      it('sets autoLogin to true', function () {
        s = SFOX.new({});
        expect(s._auto_login).toEqual(true);
      });

      it('should require a delegate', () =>
      expect(() => SFOX.new()).toThrow());
    });
  });

  describe('instance', function () {
    beforeEach(function () {
      s = SFOX.new({
        email () { return 'info@blockchain.com'; },
        mobile () { return '+1 55512345678'; },
        isEmailVerified () { return true; },
        isMobileVerified () { return true; },
        getToken () { return 'json-web-token'; },
        save () { return Promise.resolve(); }
      });
      s._debug = false;

      return spyOn(s._api, 'POST').and.callFake(function (endpoint, data) {
        if (endpoint === 'account') {
          if (data.user_data === 'fail-token') {
            return Promise.reject('ERROR_MESSAGE');
          } else {
            return Promise.resolve({
              token: 'account-token',
              account: {
                id: '1'
              },
              sfox: true
            });
          }
        } else {
          return Promise.reject('Unknown endpoint');
        }
      });
    });

    describe('Getter', () =>
      describe('hasAccount', () =>
        it('should use account_token to see if user has account', function () {
          s._accountToken = undefined;
          expect(s.hasAccount).toEqual(false);

          s._accountToken = 'token';
          expect(s.hasAccount).toEqual(true);
        })
      )
    );

    describe('Setter', function () {
      describe('autoLogin', function () {
        beforeEach(() => spyOn(s.delegate, 'save').and.callThrough());

        it('should update', function () {
          s.autoLogin = false;
          expect(s.autoLogin).toEqual(false);
        });

        it('should save', function () {
          s.autoLogin = false;
          expect(s.delegate.save).toHaveBeenCalled();
        });

        it('should check the input', () => {
          expect(() => { s.autoLogin = '1'; }).toThrow();
        });
      });

      describe('debug', function () {
        it('should set debug', function () {
          s.debug = true;
          expect(s.debug).toEqual(true);
        });

        it('should set debug flag on the delegate', function () {
          s._delegate = {debug: false};
          s.debug = true;
          expect(s.delegate.debug).toEqual(true);
        });

        it('should set debug flag on trades', () => pending());
      });
    });
          // s._trades = [{debug: false}]
          // s.debug = true
          // expect(s.trades[0].debug).toEqual(true)

    describe('JSON serializer', function () {
      let obj;

      beforeEach(function () {
        obj = {
          user: '1',
          account_token: 'token',
          auto_login: true
        };

        s = new SFOX(obj, {});
      });

      it('should serialize the right fields', function () {
        let json = JSON.stringify(s, null, 2);
        let d = JSON.parse(json);
        expect(d.user).toEqual('1');
        expect(d.account_token).toEqual('token');
        expect(d.auto_login).toEqual(true);
      });

      it('should serialize trades', () => pending());
        // p.trades = []
        // json = JSON.stringify(p, null, 2)
        // d = JSON.parse(json)
        // expect(d.trades).toEqual([])

      it('should hold: fromJSON . toJSON = id', function () {
        let json = JSON.stringify(s, null, 2);
        let b = new SFOX(JSON.parse(json), {});
        expect(json).toEqual(JSON.stringify(b, null, 2));
      });

      it('should not serialize non-expected fields', function () {
        let expectedJSON = JSON.stringify(s, null, 2);
        s.rarefield = 'I am an intruder';
        let json = JSON.stringify(s, null, 2);
        expect(json).toEqual(expectedJSON);
      });
    });

    describe('signup', function () {
      it('sets a user and account token', function (done) {
        let checks = function () {
          expect(s.user).toEqual('1');
          expect(s._accountToken).toEqual('account-token');
        };

        let promise = s.signup().then(checks);

        expect(promise).toBeResolved(done);
      });

      it('requires email', function () {
        s.delegate.email = () => null;
        expect(s.signup()).toBeRejected();
      });

      it('requires verified email', function () {
        s.delegate.isEmailVerified = () => false;
        expect(s.signup()).toBeRejected();
      });

      it('requires mobile', function () {
        s.delegate.mobile = () => null;
        expect(s.signup()).toBeRejected();
      });

      it('requires verified mobile', function () {
        s.delegate.isMobileVerified = () => false;
        expect(s.signup()).toBeRejected();
      });

      it('might fail for an unexpected reason', function (done) {
        s.delegate.getToken = () => 'fail-token';
        let promise = s.signup();
        expect(promise).toBeRejectedWith('ERROR_MESSAGE', done);
      });
    });

    describe('fetchProfile', () =>
      it('should set profile', function (done) {
        let promise = s.fetchProfile().then(() =>
          expect(s.profile).toEqual({mock: 'profile'})
        );
        expect(promise).toBeResolved(done);
      })
    );
  });
});
