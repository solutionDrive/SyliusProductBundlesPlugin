<?php

declare(strict_types=1);

/*
 * Created by solutionDrive GmbH
 *
 * @copyright 2018 solutionDrive GmbH
 */

namespace Tests\solutionDrive\SyliusProductBundlesPlugin\Behat\Page\ProductBundles;

use solutionDrive\SyliusProductBundlesPlugin\Entity\ProductBundleInterface;
use Sylius\Behat\Page\Admin\Crud\IndexPage as CrudIndexPage;

class IndexPage extends CrudIndexPage
{
    public function getPresentationSlot(ProductBundleInterface $productBundle): string
    {
        $tableAccessor = $this->getTableAccessor();
        $table = $this->getElement('table');
        $row = $tableAccessor->getRowWithFields($table, ['product.code' => $productBundle->getProduct()->getCode()]);
        $slotsField = $tableAccessor->getFieldFromRow($table, $row, 'slots');
        return $slotsField->find('css', '.presentation')->getText();
    }
}
