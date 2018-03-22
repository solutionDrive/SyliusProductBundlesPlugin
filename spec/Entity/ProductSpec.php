<?php

declare(strict_types=1);

/*
 * Created by solutionDrive GmbH
 *
 * @copyright 2018 solutionDrive GmbH
 */

namespace spec\solutionDrive\SyliusProductBundlesPlugin\Entity;

use PhpSpec\ObjectBehavior;
use solutionDrive\SyliusProductBundlesPlugin\Entity\Product;
use solutionDrive\SyliusProductBundlesPlugin\Entity\ProductBundleInterface;
use Sylius\Component\Core\Model\ProductInterface;

class ProductSpec extends ObjectBehavior
{
    public function it_is_initializable(): void
    {
        $this->shouldHaveType(Product::class);
    }

    public function it_is_a_product(): void
    {
        $this->shouldImplement(ProductInterface::class);
    }

    public function it_can_have_a_product_bundle_associated(
        ProductBundleInterface $productBundle
    ): void {
        $this->setProductBundle($productBundle);
        $this->getProductBundle()->shouldReturn($productBundle);
    }
}
