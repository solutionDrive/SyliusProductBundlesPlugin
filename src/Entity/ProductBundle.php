<?php

declare(strict_types=1);

namespace SolutionDrive\SyliusProductBundlesPlugin\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Sylius\Component\Core\Model\ProductInterface;
use Sylius\Component\Resource\Model\CodeAwareInterface;
use Sylius\Component\Resource\Model\ResourceInterface;

class ProductBundle implements ProductBundleInterface, ResourceInterface, CodeAwareInterface
{
    /** @var int */
    private $id;

    /** @var string|null */
    private $code;

    /** @var string */
    private $name;

    /** @var Collection<ProductBundleSlotInterface> */
    private $slots;

    /** @var ProductInterface */
    private $product;

    /**
     * ProductBundle constructor.
     */
    public function __construct()
    {
        $this->slots = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getCode(): ?string
    {
        return $this->code;
    }

    /**
     * @param string|null $code
     */
    public function setCode(?string $code): void
    {
        $this->code = $code;
    }

    /**
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    /**
     * @param ProductBundleSlotInterface $slot
     */
    public function addSlot(ProductBundleSlotInterface $slot): void
    {
        $this->slots->add($slot);
    }

    /**
     * @return Collection<ProductBundleSlotInterface>
     */
    public function getSlots(): Collection
    {
        return $this->slots;
    }

    /**
     * @return ProductInterface
     */
    public function getProduct(): ProductInterface
    {
        return $this->product;
    }

    /**
     * @param ProductInterface $product
     */
    public function setProduct(ProductInterface $product): void
    {
        $this->product = $product;
    }
}
