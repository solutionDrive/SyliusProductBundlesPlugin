<p align="center">
    <a href="http://sylius.org" target="_blank">
        <img src="https://demo.sylius.com/assets/shop/img/logo.png" />
    </a>
</p>

# Sylius Product Bundles Plugin
[![License](https://img.shields.io/packagist/l/solutiondrive/sylius-product-bundles-plugin.svg)](https://packagist.org/packages/solutiondrive/sylius-product-bundles-plugin)
[![Packagist](https://img.shields.io/packagist/v/solutiondrive/sylius-product-bundles-plugin.svg)](https://packagist.org/packages/solutiondrive/sylius-product-bundles-plugin)
[![Build Status](https://travis-ci.org/solutionDrive/SyliusProductBundlesPlugin.svg?branch=master)](https://travis-ci.org/solutionDrive/SyliusProductBundlesPlugin)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/solutionDrive/SyliusProductBundlesPlugin/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/solutionDrive/SyliusProductBundlesPlugin/?branch=master)

## Installation

1. Run `composer create-project sylius/plugin-skeleton ProjectName`.

2. From the plugin skeleton root directory, run the following commands:

    ```bash
    $ (cd tests/Application && yarn install)
    $ (cd tests/Application && yarn run gulp)
    $ (cd tests/Application && bin/console assets:install web -e test)
    
    $ (cd tests/Application && bin/console doctrine:database:create -e test)
    $ (cd tests/Application && bin/console doctrine:schema:create -e test)
    ```

## Definition
### ProductBundle
*ProductBundles* are a independent resource and have a OneToOne-relationship with a *Product* that represents the bundle
throughout the sylius-framework, e.g. for calculating prices and taxes in the checkout.
The content of a *ProductBundle* is organized in *ProductBundleSlots*. One ProductBundle can have 1 to n ProductBundleSlots.

### ProductBundleSlots
*ProductBundleSlots* represent a group of products that can be switched through by the customer. E.g. in a Bundle for 
football-Teams there could be a Slot 'Shirts', in which different kinds of shirts can be referenced. Only one item of
each *ProductBundleSlot* is part of the finally bought bundle.

## Usage
### ProductBundleCreator
This is a service to create ProductBundles programmatically. It will only create
Objects necessary for the ProductBundle. It won't create products for you. But if you have the products that should be 
part of the bundle you want to create, they can be associated with the created bundle and the slots inside the bundle.

#### get the service
```php
$bundleCreator = $container->get('solutiondrive.product_bundles.product_bundle_creator');
```

#### create your bundle
```php

$slotOptionsFactory = new solutionDrive\SyliusProductBundlesPlugin\Factory\ProductBundleSlotOptionsFactory();

$hatSlotOptions = $slotOptionsFactory->createNewWithValues(1, 'TopHats');

$shirtSlotOptions = $slotOptionsFactory->createNewWithValues(2, 'Shirts', ['someAdditionalOption' => 'AndItsValue']);

$bundleCreator->createProductBundle('YourAwesomeBundle', $prductRepresentationOfTheBundle);
$bundleCreator->addSlot('YourAwsomeHats', $hatSlotOptions, $hatsToAssignToSlot);
$bundleCreator->addSlot('YourAwsomeShirts', $shirtSlotOptions, $shirtsToAssignToSlot);

$productBundle = $bundleCreator->getProductBundle();
```

### Fixtures

Sometimes you'll need to set up your environment quickly and add some default bundles. 
You can take a look at `tests/Application/app/config/fixtures.yml` file to see how you can configure fixtures.


### Running plugin tests

  - PHPUnit

    ```bash
    $ bin/phpunit
    ```

  - PHPSpec

    ```bash
    $ bin/phpspec run
    ```

  - Behat (non-JS scenarios)

    ```bash
    $ bin/behat --tags="~@javascript"
    ```

  - Behat (JS scenarios)
 
    1. Download [Chromedriver](https://sites.google.com/a/chromium.org/chromedriver/)
    
    2. Run Selenium server with previously downloaded Chromedriver:
    
        ```bash
        $ bin/selenium-server-standalone -Dwebdriver.chrome.driver=chromedriver
        ```
    3. Run test application's webserver on `localhost:8080`:
    
        ```bash
        $ (cd tests/Application && bin/console server:run 127.0.0.1:8080 -d web -e test)
        ```
    
    4. Run Behat:
    
        ```bash
        $ bin/behat --tags="@javascript"
        ```

### Opening Sylius with your plugin

- Using `test` environment:

    ```bash
    $ (cd tests/Application && bin/console sylius:fixtures:load -e test)
    $ (cd tests/Application && bin/console server:run -d web -e test)
    ```
    
- Using `dev` environment:

    ```bash
    $ (cd tests/Application && bin/console sylius:fixtures:load -e dev)
    $ (cd tests/Application && bin/console server:run -d web -e dev)
    ```
