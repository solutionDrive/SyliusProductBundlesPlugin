<?php

declare(strict_types=1);

namespace solutionDrive\SyliusProductBundlesPlugin\Service\Options;

/**
 * Created by solutionDrive GmbH
 *
 * @copyright 2018 solutionDrive GmbH
 */
interface OptionsInterface
{
    public function addOption(string $name, mixed $value): void;

    public function getOption(string $name): mixed;
}
