# Silex Password Provider

[![Build Status](https://travis-ci.org/SilexFriends/Password.svg?branch=master)](https://travis-ci.org/SilexFriends/Password)
[![Code Climate](https://codeclimate.com/github/SilexFriends/Password/badges/gpa.svg)](https://codeclimate.com/github/SilexFriends/Password)
[![Test Coverage](https://codeclimate.com/github/SilexFriends/Password/badges/coverage.svg)](https://codeclimate.com/github/SilexFriends/Password/coverage)
[![Issue Count](https://codeclimate.com/github/SilexFriends/Password/badges/issue_count.svg)](https://codeclimate.com/github/SilexFriends/Password)

## Install

```
composer require mrprompt/silex-password
```

## Usage

```
use SilexFriends\Password\Password as PasswordServiceProvider;

$cost = 8;
$app->register(new PasswordServiceProvider($cost));

$passwordClean = 'abcd1234';

// generate
$passwordEncrypted = $app['password.generate']($passwordClean);

// verify
$checkPassword = $app['password.verify']($passwordClean, $passwordEncrypted);

```

## Test

```
./vendor/bin/phpunit
```

## License

MIT