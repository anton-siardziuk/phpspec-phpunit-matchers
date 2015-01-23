<?php


namespace M00t\PhpSpec\PHPUnitMatchers\Formatter\Presenter\Differ;

class Differ extends \PhpSpec\Formatter\Presenter\Differ\Differ
{
    public function compare($expected, $actual)
    {
        $constraint = new \PHPUnit_Framework_Constraint_IsEqual($expected);
        try {
            $constraint->evaluate($actual);
            throw new \Exception('Can not diff equal values');
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
            return $e->getComparisonFailure()->getDiff();
        }
    }
}