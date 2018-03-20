<?php

declare(strict_types=1);

namespace Tests\solutionDrive\SyliusProductBundlesPlugin\Behat\Page\ProductBundles;

use Behat\Mink\Driver\Selenium2Driver;
use Behat\Mink\Element\NodeElement;
use Sylius\Behat\Page\Admin\Crud\UpdatePage as CrudUpdatePage;
use Webmozart\Assert\Assert;

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

    public function associateSlotWithProducts(string $slotName, array $productCodes): void
    {
        Assert::isInstanceOf($this->getDriver(), Selenium2Driver::class);
        $slotSubForm = $this->getSlotSubForm($slotName);
        $dropDown = $slotSubForm->find('css', '.sylius-autocomplete');
        Assert::notNull($dropDown);
        $dropDown->click();
        foreach ($productCodes as $productCode) {
            $productCodeItemLocator = '.item[data-value="' . $productCode . '"]';
            $dropDown->waitFor(5, function () use ($productCodeItemLocator, $dropDown) {
                return $dropDown->has('css', $productCodeItemLocator);
            });

            $item = $dropDown->find('css', $productCodeItemLocator);
            $item->click();
        }
    }

    /**
     * @return NodeElement[]
     */
    public function getSlotSubForms(): array
    {
        $slotSubForms = [];
        $formElements = $this->getDocument()->findAll('css', '[data-qa="slot-form-section"]');

        /** @var NodeElement $element */
        foreach ($formElements as $element) {
            $slotSubForms[$element->findField('Name')->getValue()] = $element;
        }

        return $slotSubForms;
    }

    public function hasSlotWithProduct(string $slotName, string $productCode): void
    {
        $slotSubForm = $this->getSlotSubForm($slotName);
        $inputElement = $slotSubForm->find('css', 'input.autocomplete');

        $currentProductCodes = explode(',', $inputElement->getValue());

        Assert::oneOf($productCode, $currentProductCodes);
    }

    public function removeSlot(string $slotName)
    {
        Assert::isInstanceOf($this->getDriver(), Selenium2Driver::class);
        $slotSubForm = $this->getSlotSubForm($slotName);
        $slotSubForm->find('css', '[data-form-collection="delete"]')->click();
    }

    public function getSlotSubForm(string $slotName): NodeElement
    {
        $slotSubForms = $this->getSlotSubForms();
        Assert::keyExists($slotSubForms, $slotName);

        return $slotSubForms[$slotName];
    }

    protected function getDefinedElements(): array
    {
        return [
            'slot_name_0' => '#product_bundle_slots_0_name'
        ];
    }
}
