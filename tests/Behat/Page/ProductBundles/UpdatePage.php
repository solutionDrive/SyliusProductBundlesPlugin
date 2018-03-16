<?php

declare(strict_types=1);

namespace Tests\solutionDrive\SyliusProductBundlesPlugin\Behat\Page\ProductBundles;

use Sylius\Behat\Page\Admin\Crud\UpdatePage as CrudUpdatePage;

/**
 * Created by solutionDrive GmbH
 *
 * @copyright 2018 solutionDrive GmbH
 */
class UpdatePage extends CrudUpdatePage
{
    public function addSlot(string $slotName): void
    {
        $this->getDocument()->clickLink('Add slot');
        $this->getDocument()->fillField('Name', $slotName);
    }

    public function getFirstSlotName(): string
    {
        return $this->getDocument()->findField('Name')->getValue();
    }
}
