<?php

declare(strict_types=1);

namespace solutionDrive\SyliusProductBundlesPlugin\Factory;

use solutionDrive\SyliusProductBundlesPlugin\Service\Options\ProductBundleSlotOptionsInterface;
use Sylius\Component\Resource\Factory\FactoryInterface;

/**
 * Created by solutionDrive GmbH
 *
 * @copyright 2018 solutionDrive GmbH
 */
interface ProductBundleSlotOptionsFactoryInterface extends FactoryInterface
{
    public function createNewWithValues(int $position, bool $isPresentationSlot = false): ProductBundleSlotOptionsInterface;
}
