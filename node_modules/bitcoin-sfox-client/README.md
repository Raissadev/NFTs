# Bitcoin SFOX Javascript Client [![Build Status](https://travis-ci.org/blockchain/bitcoin-sfox-client.png?branch=master)](https://travis-ci.org/blockchain/bitcoin-sfox-client) [![Coverage Status](https://coveralls.io/repos/blockchain/bitcoin-sfox-client/badge.svg?branch=master&service=github)](https://coveralls.io/github/blockchain/bitcoin-sfox-client?branch=master)

This is used by [My-Wallet-V3](https://github.com/blockchain/My-Wallet-V3/).

## Install

`npm install bitcoin-sfox-client --save`

## Usage

Three things are needed:

1. `delegate` object (see [example](https://github.com/blockchain/My-Wallet-V3/blob/master/src/exchange-delegate.js)) with functions that provide the following:
 * save() -> e.g. `function () { return JSON.stringify(this._sfox);` }
 * `email()` -> String : the users email address
 * `isEmailVerified()` -> Boolean : whether the users email is verified
 * `getEmailToken()` -> stringify : JSON web token {email: 'me@example.com'}
 * `monitorAddress(address, callback)` : `callback(amount)` if btc received
 * `checkAddress(address)` : look for existing transaction at address
 * `getReceiveAddress(trade)` : return the trades receive address
 * `reserveReceiveAddress()`
 * `commitReceiveAddress()`
 * `releaseReceiveAddress()`
 * `serializeExtraFields(obj, trade)` : e.g. `obj.account_index = ...`
 * `deserializeExtraFields(obj, trade)`

2. SFOX API key

```js
var object = {user: 1, offline_token: 'token'};
var sfox = new SFOX(object, delegate);
sfox.api.apiKey = ...;
sfox.delegate.save.bind(sfox.delegate)();
// "{"user":1, ...}"
```

## Development

### Modifying bitcoin-exchange-client

To use a local version of bitcoin-exchange-client, create a symlink:

```sh
cd ..
rm -rf bitcoin-coinify-client/node_modules/bitcoin-exchange-client
ln -s ../../bitcoin-exchange-client bitcoin-coinify-client/node_modules/bitcoin-exchange-client
```

### Testing inside my-wallet-v3

To use a local version of this repo inside my-wallet-v3, create a symlink:

```sh
cd ..
rm -rf My-Wallet-V3/node_modules/bitcoin-sfox-client
ln -s ../../bitcoin-sfox-client My-Wallet-V3/node_modules/bitcoin-sfox-client
```

Note that Grunt won't detect these changes.

## Release

Change version in `package.json`.

```sh
git commit -a -m "v0.1.0"
git push
git tag -s v0.1.0
git push --tags
```
