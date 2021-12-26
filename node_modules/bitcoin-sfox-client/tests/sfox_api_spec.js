let proxyquire = require('proxyquireify')(require);

class ExchangeAPI {
  _request () {}
}

let Exchange = {
  API: ExchangeAPI
};

let stubs = {
  'bitcoin-exchange-client': Exchange
};

const API = proxyquire('../src/api', stubs);

describe('SFOX API', function () {
  let api;

  beforeEach(() => JasminePromiseMatchers.install());

  afterEach(() => JasminePromiseMatchers.uninstall());

  describe('instance', function () {
    beforeEach(function () {
      api = new API();
      api._accountToken = 'account-token';
      api._apiKey = 'api-key';
      api._partnerId = 'blockchain';
    });

    describe('Properties', function () {
      describe('hasAccount', () =>
        it('should use _accountToken to see if user has account', function () {
          api._accountToken = undefined;
          expect(api.hasAccount).toEqual(false);

          api._accountToken = 'token';
          expect(api.hasAccount).toEqual(true);
        })
      );

      describe('apiKey', () =>
        it('should allow read and write', function () {
          api.apiKey = 'a';
          expect(api.apiKey).toEqual('a');
        })
      );

      describe('partnerId', () =>
        it('should allow read and write', function () {
          api.partnerId = 'blockchain';
          expect(api.partnerId).toEqual('blockchain');
        })
      );
    });

    describe('_url()', function () {
      it('should use the api subdomain by default', () =>
      expect(api._url(undefined, undefined, 'transactions')).toContain('api.staging.sfox.com'));

      it('should use the production subdomain if specified', function () {
        api._production = true;
        expect(api._url(undefined, undefined, 'transactions')).toContain('api.sfox.com');
      });

      it('should use a custom subdomain', () =>
        expect(api._url('quote', undefined, 'transactions')).toContain('quote.staging.sfox.com'));

      it('should append the endpoint', () =>
        expect(api._url(undefined, undefined, 'transactions')).toMatch(/.*\/transactions$/));

      it('should use v2 by default', () =>
        expect(api._url(undefined, undefined, 'transactions')).toContain('/v2/'));

      it('should allow a custom version', () =>
        expect(api._url(undefined, 'v1', 'transactions')).toContain('/v1/'));

      it('should include a partner id', () =>
        expect(api._url(undefined, undefined, 'transactions')).toContain('/partner/blockchain'));
    });

    describe('_request()', function () {
      beforeEach(function () {
        spyOn(ExchangeAPI.prototype, '_request');
        return spyOn(api, '_url').and.callFake((subdomain, version, endpoint) => `/${endpoint}`);
      });

      it('should set the API key header for all requests', function () {
        api._request('GET', 'trades', 'v1', 'api', {}, false);
        expect(ExchangeAPI.prototype._request).toHaveBeenCalled();
        expect(ExchangeAPI.prototype._request.calls.argsFor(0)[3]['X-SFOX-PARTNER-ID']).toEqual('api-key');
      });

      it('should not set the API key header for quotes', function () {
        api._request('GET', 'trades', 'v1', 'quotes', {}, false);
        expect(ExchangeAPI.prototype._request.calls.argsFor(0)[3]['X-SFOX-PARTNER-ID']).not.toBeDefined();
      });

      it('should set the account token for authenticated requests', function () {
        api._request('GET', 'trades', 'v1', 'api', {}, true);
        expect(ExchangeAPI.prototype._request).toHaveBeenCalled();
        expect(ExchangeAPI.prototype._request.calls.argsFor(0)[3]['Authorization']).toEqual('Bearer account-token');
      });

      it('should not set the account token for unauthenticated requests', function () {
        api._request('GET', 'trades', 'v1', 'api', {}, false);
        expect(ExchangeAPI.prototype._request).toHaveBeenCalled();
        expect(ExchangeAPI.prototype._request.calls.argsFor(0)[3]['Authorization']).not.toBeDefined();
      });
    });

    describe('REST', function () {
      beforeEach(() => spyOn(api, '_request'));

      describe('GET', () =>
        it('should make a GET request', function () {
          api.GET('/trades');
          expect(api._request).toHaveBeenCalled();
          expect(api._request.calls.argsFor(0)[0]).toEqual('GET');
        })
      );

      describe('POST', () =>
        it('should make a POST request', function () {
          api.POST('/trades');
          expect(api._request).toHaveBeenCalled();
          expect(api._request.calls.argsFor(0)[0]).toEqual('POST');
        })
      );

      describe('PATCH', () =>
        it('should make a PATCH request', function () {
          api.PATCH('/trades');
          expect(api._request).toHaveBeenCalled();
          expect(api._request.calls.argsFor(0)[0]).toEqual('PATCH');
        })
      );

      describe('authenticated', function () {
        describe('GET', () =>
          it('should make a GET request', function () {
            api.authGET('/trades');
            expect(api._request).toHaveBeenCalled();
            expect(api._request.calls.argsFor(0)[0]).toEqual('GET');
          })
        );

        describe('POST', () =>
          it('should make a POST request', function () {
            api.authPOST('/trades');
            expect(api._request).toHaveBeenCalled();
            expect(api._request.calls.argsFor(0)[0]).toEqual('POST');
          })
        );

        describe('PATCH', () =>
          it('should make a PATCH request', function () {
            api.authPATCH('/trades');
            expect(api._request).toHaveBeenCalled();
            expect(api._request.calls.argsFor(0)[0]).toEqual('PATCH');
          })
        );
      });
    });
  });
});
