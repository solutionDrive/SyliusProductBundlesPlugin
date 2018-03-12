<?php
declare(strict_types=1);

/*
 * Created by solutionDrive GmbH
 *
 * @copyright 2018 solutionDrive GmbH
 */

namespace solutionDrive\SyliusProductBundlesPlugin\Fixture\Factory;

use solutionDrive\SyliusProductBundlesPlugin\Entity\ProductBundle;
use solutionDrive\SyliusProductBundlesPlugin\Factory\ProductBundleSlotFactoryInterface;
use Sylius\Bundle\CoreBundle\Fixture\Factory\AbstractExampleFactory;
use Sylius\Component\Core\Model\ProductInterface;
use Sylius\Component\Core\Repository\ProductRepositoryInterface;
use Sylius\Component\Resource\Factory\FactoryInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductBundleExampleFactory extends AbstractExampleFactory
{
    /**
     * @var FactoryInterface
     */
    private $productBundleFactory;
    /**
     * @var ProductBundleSlotFactoryInterface
     */
    private $productBundleSlotFactory;

    /**
     * @var OptionsResolver
     */
    private $optionsResolver;
    /**
     * @var ProductRepositoryInterface
     */
    private $productRepository;

    public function __construct(
        FactoryInterface $productBundleFactory,
        ProductRepositoryInterface $productRepository,
        ProductBundleSlotFactoryInterface $productBundleSlotFactory
    ) {
        $this->productBundleFactory = $productBundleFactory;
        $this->productRepository = $productRepository;
        $this->productBundleSlotFactory = $productBundleSlotFactory;
        $this->optionsResolver = new OptionsResolver();
        $this->configureOptions($this->optionsResolver);
    }

    /**
     * {@inheritdoc}
     */
    protected function configureOptions(OptionsResolver $resolver): void
    {
        // empty function
    }

    /**
     * {@inheritdoc}
     */
    public function create(array $options = [])
    {
        $options = $this->optionsResolver->resolve($options);

        /** @var ProductInterface $product */
        $product = $this->productRepository->findOneByCode($options['code']);

        /** @var ProductBundle $productBundle */
        $productBundle = $this->productBundleFactory->createNew();
        $productBundle->setProduct($product);
        $productBundle->setName($product->getName());
        $productBundle->setCode($product->getCode());

        return $productBundle;
    }
}
