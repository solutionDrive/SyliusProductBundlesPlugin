@managing_product_bundles
Feature: Adding Products to Product Bundle Slots
  In order to assign products to the slots of a product bundle
  As an administrator
  I want to be able to add products to the slot of a product bundle

  Background:
    Given the store has a product bundle "Hefty smurfs workout dress"
    And this product bundle has a slot named "tights"
    And this product bundle has also a slot named "hats"
    And the store has a product "Hefty smurfs workout dress"
    And this product is a product bundle product
    And the store has a product "white tight"
    And the store has a product "red tight"
    And the store has a product "white hat"
    And the store has a product "red hat"
    And this product is assigned to the slot "hats"
    And I am logged in as an administrator

  @todo
  Scenario: Adding one product to an empty slot
    Given I want to modify the "Hefty smurfs workout dress" product bundle
    When I add the "white tight" product to the "tights" slot of this product bundle
    And I save my changes
    Then I should see that the "white tight" product is added to the "tights" slot

  @todo
  Scenario: Adding a product to an slot with already assigned products
    Given I want to modify the "Hefty smurfs workout dress" product bundle
    When I add the "white hat" product to the "hats" slot of this product bundle
    And I save my changes
    Then I should see that the "red hat" and the "white hat" product are assigned to the "hats" slot
