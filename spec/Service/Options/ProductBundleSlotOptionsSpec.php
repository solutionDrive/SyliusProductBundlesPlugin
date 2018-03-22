<?php

declare(strict_types=1);

/*
 * Created by solutionDrive GmbH
 *
 * @copyright 2018 solutionDrive GmbH
 */

namespace spec\solutionDrive\SyliusProductBundlesPlugin\Service\Options;

use PhpSpec\ObjectBehavior;
use solutionDrive\SyliusProductBundlesPlugin\Service\Options\OptionsInterface;
use solutionDrive\SyliusProductBundlesPlugin\Service\Options\ProductBundleSlotOptions;
use solutionDrive\SyliusProductBundlesPlugin\Service\Options\ProductBundleSlotOptionsInterface;

class ProductBundleSlotOptionsSpec extends ObjectBehavior
{
    public function it_is_initializable(): void
    {
        $this->shouldHaveType(ProductBundleSlotOptions::class);
    }

    public function it_implements_option_interface(): void
    {
        $this->shouldImplement(OptionsInterface::class);
    }

    public function it_is_a_product_bundle_slot_options_instance(): void
    {
        $this->shouldImplement(ProductBundleSlotOptionsInterface::class);
    }

    public function it_can_add_position_to_options(): void
    {
        $position = 1;
        $this->setPosition($position);
        $this->getPosition()->shouldReturn($position);
    }

    public function it_can_be_set_as_presentation_slot(): void
    {
        $this->setAsPresentationSlot();
        $this->isPresentationSlot()->shouldReturn(true);
    }

    public function it_is_initalized_as_non_presentation_slot(): void
    {
        $this->isPresentationSlot()->shouldReturn(false);
    }

    public function it_can_handle_custom_options(): void
    {
        $optionName = 'very_special_option';
        $optionValue = 'very_special_value';

        $this->addOption($optionName, $optionValue);
        $this->getOption($optionName)->shouldReturn($optionValue);
    }
}
