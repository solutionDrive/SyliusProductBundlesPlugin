<?php

declare(strict_types=1);

namespace solutionDrive\SyliusProductBundlesPlugin\Service\Options;

/**
 * Created by solutionDrive GmbH
 *
 * @copyright 2018 solutionDrive GmbH
 */
class ProductBundleSlotOptions implements ProductBundleSlotOptionsInterface
{
    /** @var int */
    private $position;

    /** @var bool */
    private $isPresentationSlot = false;

    public function addOption(string $name, mixed $value): void
    {
        // TODO: Implement addOption() method.
    }

    public function getOption(string $name): mixed
    {
        // TODO: Implement getOption() method.
    }

    public function setPosition(int $position): void
    {
        $this->position = $position;
    }

    public function getPosition(): int
    {
        return $this->position;
    }

    public function setAsPresentationSlot(): void
    {
        $this->isPresentationSlot = true;
    }

    public function isPresentationSlot(): bool
    {
        return $this->isPresentationSlot;
    }
}
