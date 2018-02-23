@managing_product_bundles
Feature: Creating a product bundle
  In order to create a new product bundle
  As an administrator
  I want to create a new product bundle via the ui

  Background:
    Given I am logged in as an administrator

  @ui
  Scenario: creating a new product bundle from an existing product
    Given the store has a product "Smurf2Gold Conversion Machine"
    When I create a new product bundle
    And I specify its name as "Smurf2Gold Conversion Machine Bundle"
    And I specify its code as "smurf2gold-conversion-machine-bundle"
    And I associate the product "Smurf2Gold Conversion Machine" with its bundle
    And I add it
    Then I should see a product bundle "Smurf2Gold Conversion Machine Bundle"

  @todo
  Scenario: creating a new product bundle with a not yet existing product
    When I create a new product bundle
    And I specify its name as "Smurf2Gold Conversion Machine"
    And I specify its code as "smurf2gold-conversion-machine"
    And I add it
    Then I should see a product bundle "Smurf2Gold Conversion Machine"
    And I should be notified that a product has been created too.

