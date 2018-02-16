@managing_product_bundle_slots
Feature: Browsing product bundle slots in product bundle
  In order to see the slots of a product bundle
  As an administrator
  I want to see product bundle slots when looking at a product bundle

  Background:
    Given the store has a product bundle "smurf outfit"
    And the store has a product "smurf outfit"
    And this product is a product bundle product
    And I am logged in as an administrator

  @todo
  Scenario: Adding a slot to a product bundle
    When I am browsing product bundles
    And I choose product bundle "smurf outfit"
    And I edit this product bundle
    And I add 1 slot
    Then I should see the product bundle has 1 slot
