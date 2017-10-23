<?php


namespace M00t\PhpSpec\PHPUnitMatchers\Matcher;


use PhpSpec\Exception\Example\FailureException;
use PhpSpec\Exception\Example\NotEqualException;
use PhpSpec\Formatter\Presenter\Presenter;
use PhpSpec\Matcher\BasicMatcher;

class IdentityMatcher extends BasicMatcher
{

    private static $keywords = array(
        'return',
        'be',
        'equal',
        'beEqualTo',
    );

    private $presenter;

    public function __construct(Presenter $presenter)
    {
        $this->presenter = $presenter;
    }

    /**
     * @param string $name
     * @param mixed  $subject
     * @param array  $arguments
     *
     * @return bool
     */
    public function supports($name, $subject, array $arguments)
    {
        return in_array($name, self::$keywords) && 1 == count($arguments);
    }

    /**
     * @param string $name
     * @param mixed  $subject
     * @param array  $arguments
     *
     * @return NotEqualException
     */
    protected function getFailureException($name, $subject, array $arguments)
    {
        return new NotEqualException(sprintf(
            'Expected %s, but got %s.',
            $this->presenter->presentValue($arguments[0]),
            $this->presenter->presentValue($subject)
        ), $arguments[0], $subject);
    }

    /**
     * @param string $name
     * @param mixed  $subject
     * @param array  $arguments
     *
     * @return FailureException
     */
    protected function getNegativeFailureException($name, $subject, array $arguments)
    {
        return new FailureException(sprintf(
            'Did not expect %s, but got one.',
            $this->presenter->presentValue($subject)
        ));
    }

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