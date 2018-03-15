<?php

declare(strict_types=1);

/*
 * Created by solutionDrive GmbH
 *
 * @copyright 2018 solutionDrive GmbH
 */

namespace solutionDrive\SyliusProductBundlesPlugin\Service;

use solutionDrive\SyliusProductBundlesPlugin\Entity\ProductBundleInterface;
use solutionDrive\SyliusProductBundlesPlugin\Entity\ProductBundleSlotInterface;
use solutionDrive\SyliusProductBundlesPlugin\Exception\SlotNotFoundException;

class SlotFinder implements SlotFinderInterface
{
    public function findSlotInBundleByName(ProductBundleInterface $bundle, string $name): ProductBundleSlotInterface
    {
        foreach ($bundle->getSlots() as $slot) {
            if ($slot->getName() === $name) {
                return $slot;
            }
        }

        throw new SlotNotFoundException($name, $bundle);
    }
}
