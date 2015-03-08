# PHP Random

The purpose of this library is to provide random data generation that is easy to mock when unit testing.

## Installation

Require in composer.json
```json
"require": {
    "tkjn/phprandom": "*"
}
```

## Usage

```php
$random = new MtRand();

// Generate random value between 10 and 100 (inclusive)
$randomNumber = $random->rand(10, 100);
```

MtRand wraps PHP's mt_rand in the RandomIntegerInterface which can then be required as a dependency when random number generation is required.

```php
class MyAlgorithm
{
    private $random;
    public function __construct(RandomIntegerInterface $random)
    {
        $this->random = $random;
    }

    public function myMethod()
    {
        $value = $this->random->rand(12, 100);
    }
}
```

RandomIntegerInterface can easily be mocked in unit tests to provide deterministic results.
