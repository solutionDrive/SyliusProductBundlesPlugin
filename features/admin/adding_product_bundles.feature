@managing_product_bundles
Feature: Creating a product bundle
  In order to create a new product bundle
  As an administrator
  I want to create a new product bundle via the ui

  Background:
    Given I am logged in as an administrator

  @ui
  Scenario: creating a new product bundle from an existing product
    Given the store has a product "Smurf2Gold Conversion Machine Bundle"
    When I create a new product bundle
    And I associate the product "Smurf2Gold Conversion Machine Bundle" with its bundle
    When I add it
    And I browse product bundles
    Then I should see a product bundle "Smurf2Gold Conversion Machine Bundle"
