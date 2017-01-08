# PHP Random
[![Build Status](https://travis-ci.org/tkjn/phprandom.svg?branch=master)](https://travis-ci.org/tkjn/phprandom)

The purposes of this library are:
  - Provide a self-contained seeded number generator object, which doesn't rely on global state for the seed
  - Define interfaces for random data generation that can be type-hinted and are easy to mock when unit testing.

## Installation

Require `tkjn/phprandom` in composer.json

## Usage

```php
$random = new \Tkjn\Random\Integer\XorshiftStar();

// Generate random value between 10 and 100 (inclusive)
$randomNumber = $random->rand(10, 100);
```

Multiple instances will maintain their own seed unlike the built-in php `rand()` and `mt_rand()` which are seeded globally

```php
$random1 = new \Tkjn\Random\Integer\XorshiftStar(123);
$random2 = new \Tkjn\Random\Integer\XorshiftStar(123);
$random3 = new \Tkjn\Random\Integer\XorshiftStar(85874);

var_dump($random1->rand(10, 90));
var_dump($random2->rand(10, 90));
var_dump($random3->rand(10, 90));

var_dump($random1->rand(10, 90));
var_dump($random2->rand(10, 90));
var_dump($random3->rand(10, 90));
```

Results in
```
int(59)
int(59)
int(13)

int(84)
int(84)
int(15)

```
