@managing_product_bundles
Feature: Creating a product bundle
  In order to create a new product bundle
  As an administrator
  I want to create a new product bundle via the ui

  Background:
    Given I am logged in as an administrator

  @todo
  Scenario: creating a new product bundle
    When I create a new product bundle
    And I specify its name as "Smurf2Gold Conversion Machine"
    And I add it
    Then I should see a product bundle "Smurf2Gold Conversion Machine"
    When I am browsing products
    Then I should see a product with name "Smurf2Gold Conversion Machine"
    And this product is a product bundle product
