<?php

namespace spec\solutionDrive\SyliusProductBundlesPlugin\Service;

use solutionDrive\SyliusProductBundlesPlugin\Service\ProductBundleUpdater;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use solutionDrive\SyliusProductBundlesPlugin\Service\ProductBundleUpdaterInterface;

class ProductBundleUpdaterSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(ProductBundleUpdater::class);
    }

    function it_implements_the_product_bundle_updater_interface()
    {
        $this->shouldImplement(ProductBundleUpdaterInterface::class);
    }
}
