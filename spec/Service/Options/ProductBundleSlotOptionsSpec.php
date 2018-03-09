<?php

declare(strict_types=1);

namespace spec\solutionDrive\SyliusProductBundlesPlugin\Service\Options;

use solutionDrive\SyliusProductBundlesPlugin\Service\Options\OptionsInterface;
use solutionDrive\SyliusProductBundlesPlugin\Service\Options\ProductBundleSlotOptions;
use PhpSpec\ObjectBehavior;
use solutionDrive\SyliusProductBundlesPlugin\Service\Options\ProductBundleSlotOptionsInterface;

/**
 * Created by solutionDrive GmbH
 *
 * @copyright 2018 solutionDrive GmbH
 */
class ProductBundleSlotOptionsSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(ProductBundleSlotOptions::class);
    }

    function it_implements_option_interface()
    {
        $this->shouldImplement(OptionsInterface::class);
    }

    function it_is_a_product_bundle_slot_options_instance()
    {
        $this->shouldImplement(ProductBundleSlotOptionsInterface::class);
    }
}
