<?php

declare(strict_types=1);

/*
 * Created by solutionDrive GmbH
 *
 * @copyright 2018 solutionDrive GmbH
 */

namespace solutionDrive\SyliusProductBundlesPlugin\Service\Options;

interface OptionsInterface
{
    public function addOption(string $name, $value): void;

    public function getOption(string $name): void;
}
