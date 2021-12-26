let proxyquire = require('proxyquireify')(require);

let stubs = {
};

let Profile = proxyquire('../src/profile', stubs);

describe('SFOX Profile', function () {
  beforeEach(() => JasminePromiseMatchers.install());

  afterEach(() => JasminePromiseMatchers.uninstall());

  describe('class', function () {
    let api;

    beforeEach(() => {
      api = {
        authGET (method) {
          return Promise.resolve({
            token: 'account-token',
            account: {
              id: 'account-id',
              verification_status: {
                level: 'pending'
              },
              can_buy: true,
              can_sell: true,
              limits: {
                available: {
                  buy: 100,
                  sell: 100
                }
              }
            }
          });
        }
      };
    });

    describe('fetch()', function () {
      it('calls /account', function () {
        spyOn(api, 'authGET').and.callThrough();
        Profile.fetch(api);
        expect(api.authGET).toHaveBeenCalledWith('account');
      });

      it('populates the profile', function (done) {
        let promise = Profile.fetch(api).then(function (p) {
          expect(p.verificationStatus).toEqual({level: 'pending'});
          expect(p.limits).toEqual({buy: 100, sell: 100});
        });

        expect(promise).toBeResolved(done);
      });
    });
  });

  describe('instance', function () {
  });
});
