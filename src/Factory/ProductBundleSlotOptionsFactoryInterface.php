<?php

declare(strict_types=1);

/*
 * Created by solutionDrive GmbH
 *
 * @copyright 2018 solutionDrive GmbH
 */

namespace solutionDrive\SyliusProductBundlesPlugin\Factory;

use solutionDrive\SyliusProductBundlesPlugin\Service\Options\ProductBundleSlotOptionsInterface;
use Sylius\Component\Resource\Factory\FactoryInterface;

interface ProductBundleSlotOptionsFactoryInterface extends FactoryInterface
{
    public function createNewWithValues(int $position, bool $isPresentationSlot = false): ProductBundleSlotOptionsInterface;
}
