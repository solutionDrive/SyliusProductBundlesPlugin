<?php

declare(strict_types=1);

namespace spec\SolutionDrive\SyliusProductBundlesPlugin\Entity;

use PhpSpec\ObjectBehavior;
use SolutionDrive\SyliusProductBundlesPlugin\Entity\Product;
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
}
