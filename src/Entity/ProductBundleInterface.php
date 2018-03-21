<?php

declare(strict_types=1);

/*
 * Created by solutionDrive GmbH
 *
 * @copyright 2018 solutionDrive GmbH
 */

namespace solutionDrive\SyliusProductBundlesPlugin\Entity;

use Doctrine\Common\Collections\Collection;
use Sylius\Component\Core\Model\ProductInterface;
use Sylius\Component\Resource\Model\ResourceInterface;

interface ProductBundleInterface extends ResourceInterface
{
    public function getId(): ?int;

    public function addSlot(ProductBundleSlotInterface $slot): void;

    /**
     * @return ProductBundleSlotInterface[]|Collection
     */
    public function getSlots(): Collection;

    public function setPresentationSlot(ProductBundleSlotInterface $slot): void;

    public function getPresentationSlot(): ?ProductBundleSlotInterface;

    public function getProduct(): ?ProductInterface;

    public function setProduct(ProductInterface $product): void;

    public function getProductId(): ?int;
}
