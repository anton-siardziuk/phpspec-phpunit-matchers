<?php


namespace M00t\PhpSpec\PHPUnitMatchers\Runner\Maintainer;


use M00t\PhpSpec\PHPUnitMatchers\Matcher\IdentityMatcher;
use PhpSpec\Formatter\Presenter\Presenter;
use PhpSpec\Loader\Node\ExampleNode;
use PhpSpec\Runner\CollaboratorManager;
use PhpSpec\Runner\Maintainer\Maintainer;
use PhpSpec\Runner\MatcherManager;
use PhpSpec\Specification;

class PHPUnitMatchersMaintainer implements Maintainer
{

    private $presenter;

    public function __construct(Presenter $presenter)
    {
        $this->presenter = $presenter;
    }

    /**
     * @param ExampleNode $example
     *
     * @return boolean
     */
    public function supports(ExampleNode $example)
    {
        return true;
    }

    /**
     * @param ExampleNode $example
     * @param Specification $context
     * @param MatcherManager $matchers
     * @param CollaboratorManager $collaborators
     */
    public function prepare(
        ExampleNode $example,
        Specification $context,
        MatcherManager $matchers,
        CollaboratorManager $collaborators
    ) {
        $matchers->add(new IdentityMatcher($this->presenter));
    }

    /**
     * @param ExampleNode $example
     * @param Specification $context
     * @param MatcherManager $matchers
     * @param CollaboratorManager $collaborators
     */
    public function teardown(
        ExampleNode $example,
        Specification $context,
        MatcherManager $matchers,
        CollaboratorManager $collaborators
    ) {

    }

    /**
     * @return integer
     */
    public function getPriority()
    {
        return 100;
    }

}