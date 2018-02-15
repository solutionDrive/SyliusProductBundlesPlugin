@managing_product_bundle_products
Feature: Browsing product bundle products in product list
  In order to see the product-representation of a product bundle
  As an administrator
  I want to see product bundle products on the overview page of the products

  Background:
    Given the store has a product "smurf outfit"
    And this product is a product bundle product
    And I am logged in as an administrator

  @todo
  Scenario: Seeing a product bundle product in the overview of all products
    When I am browsing products
    Then I should see the product "smurf outfit"
    And this product should be a product bundle product
