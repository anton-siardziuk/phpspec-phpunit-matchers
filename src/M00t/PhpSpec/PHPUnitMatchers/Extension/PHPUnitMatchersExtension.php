<?php


namespace M00t\PhpSpec\PHPUnitMatchers\Extension;


use M00t\PhpSpec\PHPUnitMatchers\Formatter\Presenter\Differ\Differ;
use M00t\PhpSpec\PHPUnitMatchers\Runner\Maintainer\PHPUnitMatchersMaintainer;
use PhpSpec\Extension\ExtensionInterface;
use PhpSpec\ServiceContainer;

class PHPUnitMatchersExtension implements ExtensionInterface
{
    public function load(ServiceContainer $container)
    {
        $container->setShared('runner.maintainers.phpunit_matchers', function($c) {
            return new PHPUnitMatchersMaintainer(
                $c->get('formatter.presenter')
            );
        });

        $container->setShared('formatter.presenter.differ', function($c) {
            return new Differ();
        });
    }
}