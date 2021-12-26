__Blockchain Wallet V3__

#   (2017-05-30)



---

## Bug Fixes

- **send:**
  - remove cors=true
  ([152ffc73](https://github.com/blockchain/My-Wallet-V3/commit/152ffc73b6303813e1342bd73cdf7ed8d40d28b8))
  - make outputs arg more flexible in payment.txSize, remove feeType, rename bytesToKb
  ([65513b44](https://github.com/blockchain/My-Wallet-V3/commit/65513b449a64828cd2e49ab79ab94ee6d07f0e20))


## Features

- **send:**
  - use regular/priority/limits fees
  ([1da5aa7b](https://github.com/blockchain/My-Wallet-V3/commit/1da5aa7bf40c6ac2e7c922c1edddd2fb342d440f))
  - change feeType update to feePerKb
  ([c43e9235](https://github.com/blockchain/My-Wallet-V3/commit/c43e9235259abdc168487a312d358fdd23f368ee))
  - calculate tx size before amounts
  ([2ec7941e](https://github.com/blockchain/My-Wallet-V3/commit/2ec7941e652810f7571bcfe8a7a74a608fdf4d3d))
  - initial setup for new fee service
  ([c662ddd7](https://github.com/blockchain/My-Wallet-V3/commit/c662ddd7f54c35c91a498c6d8276ad404c3d4abf))


## Refactor

- **send:**
  - update feeType and rebuild payment
  ([b26283a8](https://github.com/blockchain/My-Wallet-V3/commit/b26283a868bd3dcfe8fdb4f99d44ec134bc665d9))
  - remove conf estimation times, fees uses object data type
  ([1be3bfd1](https://github.com/blockchain/My-Wallet-V3/commit/1be3bfd170d1e7252ae822c9740797dbd1700d08))


## Style

- **send:** rename feesPerKb to maxFees
  ([b7db707c](https://github.com/blockchain/My-Wallet-V3/commit/b7db707c6087d2112bba464c0855f0da79a7266b))


## Test

- **helpers:** use jasmine clock instead of setTimeout, fixes hanging tests
  ([f90d9236](https://github.com/blockchain/My-Wallet-V3/commit/f90d9236a77b464a26d3322a8c9607a75ebd1c60))


## Chore

- **release:**
  - v3.32.0
  ([3ec747d2](https://github.com/blockchain/My-Wallet-V3/commit/3ec747d20199c6cc29cb2c63e4e3378b3ff582af))
  - reenable tests in Makefile
  ([b94e1eec](https://github.com/blockchain/My-Wallet-V3/commit/b94e1eec0c7d3e0ce4fbd8ff92fd3f9cb934a865))


## Branchs merged

- Merge branch 'master' into send
  ([abeca16e](https://github.com/blockchain/My-Wallet-V3/commit/abeca16e83d7b4f76d5c3bd42d408cbeb8b46109))


## Pull requests merged

- Merge pull request #378 from blockchain/send
  ([c9c35439](https://github.com/blockchain/My-Wallet-V3/commit/c9c354391e29bc864ee939d082ff651db2d753ed))
- Merge pull request #385 from blockchain/hanging-test
  ([710a25a3](https://github.com/blockchain/My-Wallet-V3/commit/710a25a381513caf98994fafca27645d7d5e6803))
- Merge pull request #377 from blockchain/v3.31-release
  ([590a2bb0](https://github.com/blockchain/My-Wallet-V3/commit/590a2bb0cbfa12f8a66a96c9140483a5dcfa0aed))



---
<sub><sup>*Generated with [git-changelog](https://github.com/rafinskipg/git-changelog). If you have any problems or suggestions, create an issue.* :) **Thanks** </sub></sup>