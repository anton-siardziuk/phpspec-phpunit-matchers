PhpSpec PHPUnit Matchers
========================

This extension changes PhpSpec's IdentityMatcher from "===" to PHPUnit's assertEquals() method. Also it changes PhpSpec's differ to PHPUnit's one.

Motivation
----------

1. PHPUnit has time proven comparation library than does more than just "==" or "===",
so that we can simply use it and do not worry about using "shouldBeLike()" instead of "shouldReturn()".

2. Differ.

For example we have classes:

.. code-block:: php

    class Value
    {
        private $value;

        public function __construct($value)
        {
            $this->value = $value;
        }
    }

    class TestValueObject
    {
        public function getValue($value)
        {
            return new Value($value + 1);
        }
    }

    class TestValueObjectSpec extends ObjectBehavior
    {
        function it_can_get_value()
        {
            $this->getValue(42)->shouldReturn(new \Value(42));
        }
    }

PhpSpec output without this extension ("shouldReturn" was changed to "shouldBeLike")

.. code-block:: bash

    $ bin/phpspec run spec/TestValueObjectSpec.php -v
    TestValueObject
      10  ✘ it can get value
          expected [obj:Value], but got [obj:Value].

            10     function it_can_get_value()
            11     {
            12         $this->getValue(42)->shouldBeLike(new \Value(42));
            13     }
            14 }
            15


           0 vendor/phpspec/phpspec/src/PhpSpec/Matcher/ComparisonMatcher.php:74
             throw new PhpSpec\Exception\Example\NotEqualException("Expected [obj:Valu"...)
           1 [internal]
             spec\TestValueObjectSpec->it_can_get_value()


                           100%                        1
    1 specs
    1 example (1 failed)
    30ms

PhpSpec output with this extension

.. code-block:: bash

    $ bin/phpspec run spec/TestValueObjectSpec.php -v
    TestValueObject
      10  ✘ it can get value
          expected [obj:Value], but got [obj:Value].

          --- Expected
          +++ Actual
          @@ @@
           Value Object (
          -    'value' => 42
          +    'value' => 43
           )


            10     function it_can_get_value()
            11     {
            12         $this->getValue(42)->shouldReturn(new \Value(42));
            13     }
            14 }
            15


           0 vendor/phpspec/phpspec/src/PhpSpec/Matcher/IdentityMatcher.php:83
             throw new PhpSpec\Exception\Example\NotEqualException("Expected [obj:Valu"...)
           1 [internal]
             spec\TestValueObjectSpec->it_can_get_value()


                           100%                        1
    1 specs
    1 example (1 failed)
    48ms


Installation
------------

1. Define dependencies in your ``composer.json``:

.. code-block:: js

    {
        "require-dev": {
            ...

            "m00t/phpspec-phpunit-matchers": "dev-master",
        }
    }

2. Install/update your vendors:

.. code-block:: bash

    $ composer update m00t/phpspec-phpunit-matchers

3. Activate extension by specifying its class in your ``phpspec.yml``:

.. code-block:: yaml

    # phpspec.yml
    extensions:
        - M00t\PhpSpec\PHPUnitMatchers\Extension\PHPUnitMatchersExtension