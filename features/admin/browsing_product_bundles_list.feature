@managing_product_bundles
Feature: Browsing product bundles list
  In order to get an overview of available product bundles
  As an administrator
  I want to see product bundles on an overview page

  Background:
    Given the store has a product "smurf hat"
    And the store has a product "smurf house"
    And the store has a product bundle "smurf outfit"
    And I am logged in as an administrator

  @ui
  Scenario: Seeing a product bundle in the list
    When I want to see 1 product bundle in the store
    Then I should see a product bundle "smurf outfit"
