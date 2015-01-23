<?php


namespace M00t\PhpSpec\PHPUnitMatchers\Runner\Maintainer;


use M00t\PhpSpec\PHPUnitMatchers\Matcher\IdentityMatcher;
use PhpSpec\Formatter\Presenter\PresenterInterface;
use PhpSpec\Loader\Node\ExampleNode;
use PhpSpec\Runner\CollaboratorManager;
use PhpSpec\Runner\Maintainer\MaintainerInterface;
use PhpSpec\Runner\MatcherManager;
use PhpSpec\SpecificationInterface;

class PHPUnitMatchersMaintainer implements MaintainerInterface
{
    /**
     * @var \PhpSpec\Formatter\Presenter\PresenterInterface
     */
    private $presenter;

    /**
     * @param PresenterInterface $presenter
     */
    public function __construct(PresenterInterface $presenter)
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
     * @param SpecificationInterface $context
     * @param MatcherManager $matchers
     * @param CollaboratorManager $collaborators
     */
    public function prepare(ExampleNode $example, SpecificationInterface $context,
                            MatcherManager $matchers, CollaboratorManager $collaborators)
    {
        $matchers->add(new IdentityMatcher($this->presenter));
    }

    /**
     * @param ExampleNode $example
     * @param SpecificationInterface $context
     * @param MatcherManager $matchers
     * @param CollaboratorManager $collaborators
     */
    public function teardown(ExampleNode $example, SpecificationInterface $context,
                             MatcherManager $matchers, CollaboratorManager $collaborators)
    {

    }

    /**
     * @return integer
     */
    public function getPriority()
    {
        return 100;
    }

}