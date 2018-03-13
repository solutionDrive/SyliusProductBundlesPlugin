<?php

declare(strict_types=1);

/*
 * Created by solutionDrive GmbH
 *
 * @copyright 2018 solutionDrive GmbH
 */

namespace solutionDrive\SyliusProductBundlesPlugin\Fixture\Factory;

use solutionDrive\SyliusProductBundlesPlugin\Entity\ProductBundleInterface;
use solutionDrive\SyliusProductBundlesPlugin\Service\Options\ProductBundleSlotOptions;
use solutionDrive\SyliusProductBundlesPlugin\Service\Options\ProductBundleSlotOptionsInterface;
use solutionDrive\SyliusProductBundlesPlugin\Service\ProductBundleCreatorInterface;
use Sylius\Bundle\CoreBundle\Fixture\Factory\AbstractExampleFactory;
use Sylius\Component\Core\Model\ProductInterface;
use Sylius\Component\Core\Repository\ProductRepositoryInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Webmozart\Assert\Assert;

class ProductBundleExampleFactory extends AbstractExampleFactory
{
    /**
     * @var ProductBundleCreatorInterface
     */
    private $productBundleCreator;

    /**
     * @var ProductRepositoryInterface
     */
    private $productRepository;

    /**
     * @var OptionsResolver
     */
    private $optionsResolver;

    public function __construct(
        ProductBundleCreatorInterface $productBundleCreator,
        ProductRepositoryInterface $productRepository
    ) {
        $this->productBundleCreator = $productBundleCreator;
        $this->productRepository = $productRepository;
        $this->optionsResolver = new OptionsResolver();
        $this->configureOptions($this->optionsResolver);
    }

    /**
     * {@inheritdoc}
     */
    protected function configureOptions(OptionsResolver $resolver): void
    {
        $resolver
            ->setDefined('productCode')
            ->setAllowedTypes('productCode', 'string')
            ->setDefined('slots')
            ->setAllowedTypes('slots', 'array');
    }

    /**
     * {@inheritdoc}
     */
    public function create(array $options = []): ProductBundleInterface
    {
        $options = $this->optionsResolver->resolve($options);

        /** @var ProductInterface $product */
        $product = $this->productRepository->findOneByCode($options['productCode']);

        Assert::notNull($product, sprintf('Bundle product %s could not be found', $options['productCode']));
        $productBundleCreator = $this->productBundleCreator->createProductBundle($product->getName(), $product);

        foreach ($options['slots'] as $slot) {
            $slotProducts = [];
            foreach ($slot['productCodes'] as $productCode) {
                $slotProduct = $this->productRepository->findOneByCode($productCode);
                Assert::notNull($slotProduct, sprintf('Slot product %s could not be found', $productCode));
                $slotProducts[] = $slotProduct;
            }
            $slotOptions = $this->createSlotOptions($slot['options']);
            $productBundleCreator->addSlot($slot['name'], $slotOptions, $slotProducts);
        }

        /** @var ProductBundleInterface $productBundle */
        $productBundle = $productBundleCreator->getProductBundle();
        $productBundle->setCode($product->getCode());

        return $productBundle;
    }

    /**
     * @param string[] $rawSlotOptions
     */
    private function createSlotOptions(array $rawSlotOptions = []): ProductBundleSlotOptionsInterface
    {
        $slotOptions = new ProductBundleSlotOptions();
        foreach ($rawSlotOptions as $optionName => $optionValue) {
            $setter = 'set' . ucfirst($optionName);

            Assert::methodExists($slotOptions, $setter, sprintf('Setter %s for ProductBundleSlotOptions is not defined', $setter));

            if (method_exists($slotOptions, $setter = 'set' . ucfirst($optionName))) {
                $slotOptions->$setter($optionValue);
            }
        }

        return $slotOptions;
    }
}
