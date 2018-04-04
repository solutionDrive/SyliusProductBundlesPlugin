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
use Sylius\Component\Resource\Model\ResourceInterface;

class ProductBundleSlot implements ProductBundleSlotInterface, ResourceInterface
{
    /** @var int */
    private $id;

    /** @var string|null */
    private $name;

    /** @var int */
    private $position = 0;

    /** @var ProductBundleInterface */
    private $bundle;

    /** @var ProductInterface[]|Collection|ArrayCollection */
    private $products;

    public function __construct()
    {
        $this->products = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getPosition(): int
    {
        return $this->position;
    }

    public function setPosition(?int $position): void
    {
        $this->position = (int) $position;
    }

    public function getBundle(): ?ProductBundleInterface
    {
        return $this->bundle;
    }

    public function setBundle(?ProductBundleInterface $bundle): void
    {
        $this->bundle = $bundle;
    }

    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function addProduct(ProductInterface $product): void
    {
        if (false === $this->hasProduct($product)) {
            $this->products->add($product);
        }
    }

    public function removeProduct(ProductInterface $product): void
    {
        if ($this->hasProduct($product)) {
            $this->products->removeElement($product);
        }
    }

    public function hasProduct(ProductInterface $product): bool
    {
        return $this->products->contains($product);
    }

    public function resetSlot(): void
    {
        $this->products->clear();
    }

    public function isPresentationSlot(): bool
    {
        return $this->bundle->getPresentationSlot() === $this;
    }
}
