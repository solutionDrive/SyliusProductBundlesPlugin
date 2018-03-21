<?php

declare(strict_types=1);

/*
 * Created by solutionDrive GmbH
 *
 * @copyright 2018 solutionDrive GmbH
 */

namespace solutionDrive\SyliusProductBundlesPlugin\Service\Options;

interface ProductBundleSlotOptionsInterface extends OptionsInterface
{
    public function setPosition(int $position): void;

    public function getPosition(): int;

    public function setAsPresentationSlot(): void;

    public function isPresentationSlot(): bool;
}
