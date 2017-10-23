<?php


namespace M00t\PhpSpec\PHPUnitMatchers\Extension;


use M00t\PhpSpec\PHPUnitMatchers\Formatter\Presenter\Differ\Differ;
use M00t\PhpSpec\PHPUnitMatchers\Runner\Maintainer\PHPUnitMatchersMaintainer;
use PhpSpec\Extension;
use PhpSpec\ServiceContainer;

class PHPUnitMatchersExtension implements Extension
{
    public function load(ServiceContainer $container, array $params)
    {
        $container->define('runner.maintainers.phpunit_matchers', function(ServiceContainer $c) {
            return new PHPUnitMatchersMaintainer(
                $c->get('formatter.presenter')
            );
        });

        $container->define('formatter.presenter.differ', function($c) {
            return new Differ();
        });
    }
}