<?php

declare(strict_types=1);

/*
 * Created by solutionDrive GmbH
 *
 * @copyright 2018 solutionDrive GmbH
 */

namespace solutionDrive\SyliusProductBundlesPlugin\Service\Options;

class ProductBundleSlotOptions implements ProductBundleSlotOptionsInterface
{
    /** @var int */
    private $position;

    /** @var bool */
    private $isPresentationSlot = false;

    /** @var mixed[] */
    private $additionalOptions = [];

    /**
     * {@inheritdoc}
     */
    public function addOption(string $name, $value): void
    {
        $this->additionalOptions[$name] = $value;
    }

    /**
     * {@inheritdoc}
     */
    public function getOption(string $name)
    {
        return $this->additionalOptions[$name];
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
