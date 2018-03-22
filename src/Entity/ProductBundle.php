<?php

declare(strict_types=1);

/*
 * Created by solutionDrive GmbH
 *
 * @copyright 2018 solutionDrive GmbH
 */

namespace solutionDrive\SyliusProductBundlesPlugin\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Sylius\Component\Core\Model\ProductInterface;

class ProductBundle implements ProductBundleInterface
{
    /** @var int */
    private $id;

    /** @var ProductBundleSlotInterface[]|Collection|ArrayCollection */
    private $slots;

    /** @var ProductBundleSlotInterface|null */
    private $presentationSlot;

    /** @var ProductInterface|null */
    private $product;

    /**
     * ProductBundle constructor.
     */
    public function __construct()
    {
        $this->slots = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function addSlot(ProductBundleSlotInterface $slot): void
    {
        if (!$this->slots->contains($slot)) {
            $slot->setBundle($this);
            $this->slots->add($slot);
        }
    }

    public function removeSlot(ProductBundleSlotInterface $slot): void
    {
        if ($this->slots->contains($slot)) {
            $this->slots->removeElement($slot);
            $slot->setBundle(null);
        }
    }

    /**
     * @return ProductBundleSlotInterface[]|Collection|ArrayCollection
     */
    public function getSlots(): Collection
    {
        return $this->slots;
    }

    public function getProduct(): ?ProductInterface
    {
        return $this->product;
    }

    public function setProduct(ProductInterface $product): void
    {
        $this->product = $product;
    }

    public function getProductId(): ?int
    {
        if (null === $this->product) {
            return null;
        }

        return $this->product->getId();
    }

    public function setPresentationSlot(ProductBundleSlotInterface $slot): void
    {
        $this->presentationSlot = $slot;
    }

    public function getPresentationSlot(): ?ProductBundleSlotInterface
    {
        return $this->presentationSlot;
    }
}
