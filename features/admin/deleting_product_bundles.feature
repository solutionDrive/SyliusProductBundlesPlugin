@managing_product_bundles
Feature: Deleting a product bundle
In order to delete an existing product bundle
As an administrator
I want to delete an existing product bundle via the ui

  Background:
    Given the store has a product bundle "Smurf Outfit Bundle"
    And I am logged in as an administrator

  @ui
  Scenario: deleting a product bundle from the Product-Bundle backend
    Given the store has also a product bundle "Smurf2Gold Conversion Machine Bundle"
    When I browse product bundles
    And I delete this product bundle
    Then I should not see a product bundle "Smurf2Gold Conversion Machine Bundle"
    And I should still see a product bundle "Smurf Outfit Bundle"
