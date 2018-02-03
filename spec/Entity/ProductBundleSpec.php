<?php

namespace spec\SolutionDrive\SyliusProductBundlesPlugin\Entity;

use SolutionDrive\SyliusProductBundlesPlugin\Entity\ProductBundle;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use SolutionDrive\SyliusProductBundlesPlugin\Entity\ProductBundleInterface;
use Sylius\Component\Resource\Model\CodeAwareInterface;
use Sylius\Component\Resource\Model\ResourceInterface;

class ProductBundleSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(ProductBundle::class);
    }

    function it_implements_product_bundle_interface()
    {
        $this->shouldImplement(ProductBundleInterface::class);
    }

    function it_implements_resource_interface()
    {
        $this->shouldImplement(ResourceInterface::class);
    }

    function it_implements_code_aware_interface()
    {
        $this->shouldImplement(CodeAwareInterface::class);
    }
}
