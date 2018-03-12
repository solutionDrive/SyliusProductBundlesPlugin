<?php

declare(strict_types=1);

namespace spec\solutionDrive\SyliusProductBundlesPlugin\Service\Options;

use PhpSpec\ObjectBehavior;
use solutionDrive\SyliusProductBundlesPlugin\Service\Options\OptionsInterface;
use solutionDrive\SyliusProductBundlesPlugin\Service\Options\ProductBundleSlotOptions;
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

    function it_can_add_position_to_options()
    {
        $position = 1;
        $this->setPosition($position);
        $this->getPosition()->shouldReturn($position);
    }

    function it_can_be_set_as_presentation_slot()
    {
        $this->setAsPresentationSlot();
        $this->isPresentationSlot()->shouldReturn(true);
    }

    function it_is_initalized_as_non_presentation_slot()
    {
        $this->isPresentationSlot()->shouldReturn(false);
    }

    function it_can_handle_custom_options()
    {
        $optionName = 'very_special_option';
        $optionValue = 'very_special_value';

        $this->addOption($optionName, $optionValue);
        $this->getOption($optionName)->shouldReturn($optionValue);
    }
}
