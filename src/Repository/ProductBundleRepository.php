<?php

declare(strict_types=1);

/*
 * Created by solutionDrive GmbH
 *
 * @copyright 2018 solutionDrive GmbH
 */

namespace solutionDrive\SyliusProductBundlesPlugin\Repository;

use solutionDrive\SyliusProductBundlesPlugin\Entity\ProductBundleInterface;
use Sylius\Bundle\ResourceBundle\Doctrine\ORM\EntityRepository;

class ProductBundleRepository extends EntityRepository implements ProductBundleRepositoryInterface
{
    /**
     * @param string $locale
     *
     * @return array|ProductBundleInterface[]
     */
    public function findByName(string $name, string $locale): array
    {
        return $this->createQueryBuilder('b')
            ->innerJoin('b.product', 'o')
            ->innerJoin('o.translations', 'translation', 'WITH', 'translation.locale = :locale')
            ->andWhere('translation.name = :name')
            ->setParameter('name', $name)
            ->setParameter('locale', $locale)
            ->getQuery()
            ->getResult();
    }
}
