# Blockchain Statistics Module

Get statistics and historical chart data for the bitcoin network. [View full API documentation](https://blockchain.info/api/charts_api).

## Importing

```js
var statistics = require('blockchain.info/statistics');
```

## Methods

All method options can include an `apiCode` property to prevent hitting request limits.

### get

Usage:

```js
statistics.get(options);
```

Responds with a json *object* containing an overview of many Bitcoin statistics (view an example response [here][stats]), unless the `stat` option is specified.

Options (optional):

  * `stat` - get only one specific stat, rather than the entire json object response, ex: `"n_btc_mined"` (*string*)

### getChartData

Usage:

```js
statistics.getChartData(chartType, options);
```

Responds with a json *object* that has a `values` property set to an *array* of chart coordinate objects in the form: {x:<*number*>,y:<*number*>}.

Parameters:

  * `chartType` - specifies which chart you want to get, ex: "total-bitcoin" (*string*, required)

[stats]: https://blockchain.info/api/charts_api
