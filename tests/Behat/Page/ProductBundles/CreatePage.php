<?php

declare(strict_types=1);

namespace Tests\solutionDrive\SyliusProductBundlesPlugin\Behat\Page\ProductBundles;

use Sylius\Behat\Behaviour\NamesIt;
use Sylius\Behat\Behaviour\SpecifiesItsCode;
use Sylius\Behat\Page\Admin\Crud\CreatePage as CrudCreatePage;

/**
 * Created by solutionDrive GmbH
 *
 * @copyright 2018 solutionDrive GmbH
 */

final class CreatePage extends CrudCreatePage
{
    use SpecifiesItsCode;
    use NamesIt;

    public function specifyProductId($id)
    {
        $this->getDocument()->selectFieldOption('Product', $id);
    }

    public function specifyProductName($name)
    {
        $this->getDocument()->selectFieldOption('Product', $name);
    }
}
