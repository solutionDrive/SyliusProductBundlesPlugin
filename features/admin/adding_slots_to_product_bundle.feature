@managing_product_bundle_slots
Feature: Browsing product bundle slots in product bundle
  In order to see the slots of a product bundle
  As an administrator
  I want to see product bundle slots when looking at a product bundle

  Background:
    Given the store has a product bundle "smurf outfit"
    And I am logged in as an administrator

  @ui
  Scenario: Adding a slot to a product bundle
    When I want to modify the "smurf outfit" product bundle
    And I add the slot "headgear"
    And I save my changes
    Then I should see the product bundle has the slot "headgear"
