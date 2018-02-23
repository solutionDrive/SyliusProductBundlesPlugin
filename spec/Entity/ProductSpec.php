<?php

namespace spec\SolutionDrive\SyliusProductBundlesPlugin\Entity;

use SolutionDrive\SyliusProductBundlesPlugin\Entity\Product;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use SolutionDrive\SyliusProductBundlesPlugin\Entity\ProductBundleInterface;
use Sylius\Component\Core\Model\ProductInterface;

class ProductSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Product::class);
    }

    function it_is_a_product()
    {
        $this->shouldImplement(ProductInterface::class);
    }

    function it_can_have_a_product_bundle_associated(
        ProductBundleInterface $productBundle
    ) {
        $this->setProductBundle($productBundle);
        $this->getProductBundle()->shouldReturn($productBundle);
    }

    function it_tells_whether_a_product_bundle_should_be_created()
    {
        $this->setCreateBundle(true);
        $this->getCreateBundle()->shouldReturn(true);
    }

}
