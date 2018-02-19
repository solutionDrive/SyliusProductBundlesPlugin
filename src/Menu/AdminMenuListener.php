<?php

declare(strict_types=1);

namespace SolutionDrive\SyliusProductBundlesPlugin\Menu;

use Sylius\Bundle\UiBundle\Menu\Event\MenuBuilderEvent;

/**
 * Created by solutionDrive GmbH
 *
 * @copyright 2018 solutionDrive GmbH
 */
final class AdminMenuListener
{
    public function addProductBundlesMenu(MenuBuilderEvent $builderEvent): void
    {
        $catalogSubnemu = $builderEvent->getMenu()->getChild('catalog');
        $catalogSubnemu
            ->addChild('product_bundles', ['route' => 'solutiondrive_admin_product_bundle_index'])
            ->setLabel('Product Bundles')
            ->setLabelAttribute('icon', 'sitemap');
    }
}
