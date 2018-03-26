<?php

declare(strict_types=1);

/*
 * Created by solutionDrive GmbH
 *
 * @copyright 2018 solutionDrive GmbH
 */

namespace solutionDrive\SyliusProductBundlesPlugin\Repository;

use solutionDrive\SyliusProductBundlesPlugin\Entity\ProductBundleInterface;

interface ProductBundleRepositoryInterface
{
    /**
     * @return array|ProductBundleInterface[]
     */
    public function findByName(string $name, string $locale): array;

    public function findOneByCode(string $code): ?ProductBundleInterface;
}
