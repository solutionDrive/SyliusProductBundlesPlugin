<?php
/**
 * Created by solutionDrive GmbH.
 *
 * @author:    Tobias Lückel <lueckel@solutionDrive.de>
 * @date:      03.02.18
 * @time:      12:33
 * @copyright: 2018 solutionDrive GmbH
 */
declare(strict_types=1);

namespace SolutionDrive\SyliusProductBundlesPlugin\Entity;

use Doctrine\Common\Collections\Collection;
use Sylius\Component\Core\Model\ProductInterface;

interface ProductBundleInterface
{
    /**
     * @return int|null
     */
    public function getId(): ?int;
    /**
     * @return string
     */
    public function getName(): ?string;

    /**
     * @param string $name
     */
    public function setName(?string $name): void;

    /**
     * @param ProductBundleSlotInterface $slot
     */
    public function addSlot(ProductBundleSlotInterface $slot): void;

    /**
     * @return ProductBundleSlotInterface[]|Collection
     */
    public function getSlots(): Collection;

    /**
     * @param ProductBundleSlotInterface $slot
     */
    public function setPresentationSlot(ProductBundleSlotInterface $slot): void;

    /**
     * @return null|ProductBundleSlotInterface
     */
    public function getPresentationSlot(): ?ProductBundleSlotInterface;

    /**
     * @return ProductInterface
     */
    public function getProduct(): ?ProductInterface;

    /**
     * @param ProductInterface $product
     */
    public function setProduct(ProductInterface $product): void;
    /**
     * @return int|null
     */
    public function getProductId(): ?int;
}
