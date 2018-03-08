<?php

declare(strict_types=1);

namespace spec\solutionDrive\SyliusProductBundlesPlugin\Service;

use PhpSpec\ObjectBehavior;
use solutionDrive\SyliusProductBundlesPlugin\Entity\ProductBundleInterface;
use solutionDrive\SyliusProductBundlesPlugin\Exception\ProductIsNotAProductBundleException;
use solutionDrive\SyliusProductBundlesPlugin\Service\ProductBundleRegistry;
use solutionDrive\SyliusProductBundlesPlugin\Service\ProductBundleRegistryInterface;
use Sylius\Component\Core\Model\ProductInterface;
use Sylius\Component\Resource\Repository\RepositoryInterface;

/**
 * Created by solutionDrive GmbH.
 *
 * @copyright 2018 solutionDrive GmbH
 */
class ProductBundleRegistrySpec extends ObjectBehavior
{
    function let(
        RepositoryInterface $productBundleRepository
    ) {
        $this->beConstructedWith($productBundleRepository);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(ProductBundleRegistry::class);
    }

    function it_implements_interface()
    {
        $this->shouldImplement(ProductBundleRegistryInterface::class);
    }

    function it_can_check_if_product_is_product_bundle_returns_false(
        ProductInterface $product,
        RepositoryInterface $productBundleRepository
    ) {
        $productBundleRepository->findOneBy(['product' => $product])->willReturn(null);
        $this->isProductBundle($product)->shouldReturn(false);
    }

    function it_can_check_if_product_is_product_bundle_returns_true(
        ProductInterface $product,
        ProductBundleInterface $productBundle,
        RepositoryInterface $productBundleRepository
    ) {
        $productBundleRepository->findOneBy(['product' => $product])->willReturn($productBundle);
        $this->isProductBundle($product)->shouldReturn(true);
    }

    function it_can_get_product_bundle_for_product(
        ProductInterface $product,
        ProductBundleInterface $productBundle,
        RepositoryInterface $productBundleRepository
    ) {
        $productBundleRepository->findOneBy(['product' => $product])->willReturn($productBundle);
        $this->getProductBundleForProduct($product)->shouldReturn($productBundle);
    }

    function it_should_throw_an_exception_if_no_product_bundle_was_found(
        ProductInterface $product,
        RepositoryInterface $productBundleRepository
    ) {
        $productBundleRepository->findOneBy(['product' => $product])->willReturn(null);

        $this
            ->shouldThrow(ProductIsNotAProductBundleException::class)
            ->during('getProductBundleForProduct', [$product]);
    }
}
