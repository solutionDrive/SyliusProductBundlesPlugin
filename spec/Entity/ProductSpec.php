<?php

declare(strict_types=1);

namespace spec\solutionDrive\SyliusProductBundlesPlugin\Entity;

use PhpSpec\ObjectBehavior;
use solutionDrive\SyliusProductBundlesPlugin\Entity\Product;
use solutionDrive\SyliusProductBundlesPlugin\Entity\ProductBundleInterface;
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
