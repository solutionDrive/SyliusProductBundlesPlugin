@managing_product_bundles
Feature: Removing slots from a product bundle
  In order to mangage product bundle slots
  As an administrator
  I want to be able to remove previously assigned slots from a product bundle

  Background:
    Given the store has a product "smurf hat"
    And the store has a product bundle "smurf outfit"
    And this product bundle has a slot named "headgear" with the "smurf hat" product
    And I am logged in as an administrator

  @ui @javascript
  Scenario: Deleting a slot from a product bundle via backend
    When I want to modify the "smurf outfit" product bundle
    And I remove the slot named "headgear"
    And I save my changes
    And I want to modify the "smurf outfit" product bundle again
    Then I should see the product bundle has no slot named "headgear"
