'use strict';

var statistics  = require('./index')
  , nock        = require('nock')
  , expect      = require('chai').expect;

describe('statistics', function () {

  describe('.get()', function () {

    nock('https://blockchain.info')
      .get('/stats').query(true).times(3)
      .reply(200, { market_price_usd: 999.99 });

    it('should get a list of stats', function (done) {
      statistics.get()
        .then(function (data) {
          expect(data.market_price_usd).to.equal(999.99);
          done();
        })
        .catch(done);
    });

    it('should get a single stat if specified', function (done) {
      statistics.get({ stat: 'market_price_usd' })
        .then(function (data) {
          expect(data).to.equal(999.99);
          done();
        })
        .catch(done);
    });

    it('should reject a nonexistant stat', function (done) {
      statistics.get({ stat: 'satoshis_coords' })
        .then(done)
        .catch(function (err) {
          expect(err).to.equal('Received unknown stat option');
          done();
        });
    });

  });

  describe('.getChartData()', function () {
    var chartData = [ { x: 100, y: 4 }
                    , { x: 101, y: 8 } ];

    nock('https://blockchain.info')
      .get('/charts/market-cap').query(true)
      .reply(200, { values: chartData });

    it('should get a list of chart points', function (done) {
      statistics.getChartData('market-cap')
        .then(function (data) {
          expect(data).to.deep.equal(chartData);
          done();
        })
        .catch(done);
    });

  });

});
