<?php

declare(strict_types=1);

namespace SolutionDrive\SyliusProductBundlesPlugin\Entity;

use Doctrine\Common\Collections\Collection;
use Sylius\Component\Core\Model\ProductInterface;

/**
 * Created by solutionDrive GmbH.
 *
 * @copyright 2018 solutionDrive GmbH
 */
interface ProductBundleSlotInterface
{
    public function getId(): int;

    public function getName(): string;

    public function setName(string $name): void;

    public function getPosition(): int;

    public function setPosition(int $position): void;

    public function getBundle(): ?ProductBundleInterface;

    public function setBundle(ProductBundleInterface $bundle): void;

    public function getProducts(): Collection;

    public function addProduct(ProductInterface $product): void;
}