<?php


namespace M00t\PhpSpec\PHPUnitMatchers\Matcher;


class IdentityMatcher extends \PhpSpec\Matcher\IdentityMatcher
{
    protected function matches($subject, array $arguments)
    {
        try {
            \PHPUnit_Framework_Assert::assertEquals($arguments[0], $subject);
            return true;
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
            return false;
        }
    }

    public function getPriority()
    {
        return 101;
    }
}