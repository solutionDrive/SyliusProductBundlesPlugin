@managing_product_bundles
Feature: Browsing product bundle slots in product bundle
  In order to see the slots of a product bundle
  As an administrator
  I want to see product bundle slots when looking at a product bundle

  Background:
    Given the store operates on a single channel in "United States"
    And the store has a product bundle "smurf outfit"
    And the store has a product "smurf hat"
    And I am logged in as an administrator

  @ui @javascript
  Scenario: Adding an empty slot to a product bundle
    When I want to modify the "smurf outfit" product bundle
    And I add the slot "headgear"
    And I save my changes
    And I want to modify the "smurf outfit" product bundle again
    Then I should see the product bundle has a slot named "headgear"

 @ui @javascript
  Scenario: Adding a slot with an product to a product bundle
    When I want to modify the "smurf outfit" product bundle
    And I add the slot "headgear"
    And I add the product "smurf outfit" to the slot "headgear"
    And I save my changes
    And I want to modify the "smurf outfit" product bundle again
    Then I should see the product bundle has a slot named "headgear" with the "smurf outfit" product
