@managing_product_bundles
Feature: Product bundle validation
  In order to avoid making mistakes when managing a product bundle
  As an Administrator
  I want to be prevented from adding or editing it without specifying required fields

  Background:
    Given the store has a product "smurf hat"
    And the store has a product bundle "smurf outfit"
    And this product bundle has a slot named "headgear" with the "smurf hat" product
    And I am logged in as an administrator

  @ui @todo
  Scenario: Adding a new product bundle without specifying a product
    When I try to create a new product bundle
    And I try to add it
    Then I should be notified that a product has to be defined

  @ui @javascript
  Scenario: Adding a new product bundle slot without specifying a slot name
    When I try to create a new product bundle
    And I associate the product "smurf hat" with its bundle
    And I add an empty slot
    And I try to add it
    Then I should be notified that "slot name 0" is required

  @ui @todo
  Scenario: Adding a new product bundle slot for an existing product bundle
    When I try to create a new product bundle
    And I associate the product "smurf outfit" with its bundle
    And I try to add it
    Then I should be notified that this product is already defined as product bundle


