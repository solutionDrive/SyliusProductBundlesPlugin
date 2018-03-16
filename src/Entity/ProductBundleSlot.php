<?php

declare(strict_types=1);

namespace solutionDrive\SyliusProductBundlesPlugin\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Sylius\Component\Core\Model\ProductInterface;
use Sylius\Component\Resource\Model\ResourceInterface;

/**
 * Created by solutionDrive GmbH.
 *
 * @copyright 2018 solutionDrive GmbH
 */
class ProductBundleSlot implements ProductBundleSlotInterface, ResourceInterface
{
    /** @var int */
    private $id;

    /** @var string */
    private $name = '';

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

    public function getName(): string
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

    public function setPosition(int $position): void
    {
        $this->position = $position;
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
        if (!$this->products->contains($product)) {
            $this->products->add($product);
        }
    }

    public function removeProduct(ProductInterface $product): void
    {
        if ($this->products->contains($product)) {
            $this->products->removeElement($product);
        }
    }
}
