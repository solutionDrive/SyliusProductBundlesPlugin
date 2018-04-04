@managing_product_bundles
Feature: Editing the presentation slot for a product bundle
  In order to manage product bundle slots
  As an administrator
  I want to be able to set the presentation slot for a product bundle

  Background:
    Given the store operates on a single channel in "United States"
    And the store has a product "smurf hat"
    And the store has a product "smurf shorts"
    And the store has a product bundle "smurf outfit"
    And this product bundle has a slot named "headgear" with the "smurf hat" product
    And this product bundle has a slot named "shorts" with the "smurf shorts" product
    And I am logged in as an administrator

  @ui
  Scenario: Define the presentation slot for a product bundle without presentation slot
    When I want to modify the "smurf outfit" product bundle
    And I specify the slot "headgear" as presentation slot
    And I save my changes
    And I browse product bundles
    Then I should see that the "smurf outfit" product bundle has the presentation slot "headgear"
