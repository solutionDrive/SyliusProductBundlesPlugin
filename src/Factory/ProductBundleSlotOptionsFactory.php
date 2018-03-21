<?php

declare(strict_types=1);

/*
 * Created by solutionDrive GmbH
 *
 * @copyright 2018 solutionDrive GmbH
 */

namespace solutionDrive\SyliusProductBundlesPlugin\Factory;

use solutionDrive\SyliusProductBundlesPlugin\Service\Options\ProductBundleSlotOptions;
use solutionDrive\SyliusProductBundlesPlugin\Service\Options\ProductBundleSlotOptionsInterface;

class ProductBundleSlotOptionsFactory implements ProductBundleSlotOptionsFactoryInterface
{
    public function createNew(): ProductBundleSlotOptionsInterface
    {
        return new ProductBundleSlotOptions();
    }

    /**
     * @param bool  $isPresentationSlot
     * @param array $additionalOptions  ['optionKey' => 'optionValue']
     *
     */
    public function createNewWithValues(
        int $position,
        bool $isPresentationSlot = false,
        array $additionalOptions = []
    ): ProductBundleSlotOptionsInterface {
        $productBundleSlotOptions = $this->createNew();
        $productBundleSlotOptions->setPosition($position);

        if ($isPresentationSlot) {
            $productBundleSlotOptions->setAsPresentationSlot();
        }

        foreach ($additionalOptions as $name => $value) {
            $productBundleSlotOptions->addOption($name, $value);
        }

        return $productBundleSlotOptions;
    }
}
