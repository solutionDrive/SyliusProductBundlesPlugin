<?php

declare(strict_types=1);

namespace solutionDrive\SyliusProductBundlesPlugin\Service\Options;

/**
 * Created by solutionDrive GmbH
 *
 * @copyright 2018 solutionDrive GmbH
 */
interface ProductBundleSlotOptionsInterface extends OptionsInterface
{
    public function setPosition(int $position): void;

    public function getPosition(): int;

    public function setAsPresentationSlot(): void;

    public function isPresentationSlot(): bool;
}
