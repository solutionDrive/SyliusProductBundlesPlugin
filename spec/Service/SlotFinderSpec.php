<?php

declare(strict_types=1);

/*
 * Created by solutionDrive GmbH
 *
 * @copyright 2018 solutionDrive GmbH
 */

namespace spec\solutionDrive\SyliusProductBundlesPlugin\Service;

use Doctrine\Common\Collections\ArrayCollection;
use PhpSpec\ObjectBehavior;
use solutionDrive\SyliusProductBundlesPlugin\Entity\ProductBundleInterface;
use solutionDrive\SyliusProductBundlesPlugin\Entity\ProductBundleSlotInterface;
use solutionDrive\SyliusProductBundlesPlugin\Exception\SlotNotFoundException;
use solutionDrive\SyliusProductBundlesPlugin\Service\SlotFinder;
use solutionDrive\SyliusProductBundlesPlugin\Service\SlotFinderInterface;

class SlotFinderSpec extends ObjectBehavior
{
    function let(
        ProductBundleInterface $bundle,
        ProductBundleSlotInterface $slot1,
        ProductBundleSlotInterface $slot2,
        ProductBundleSlotInterface $slot3
    ) {
        $slot1->getName()->willReturn('slot1');
        $slot1->getBundle()->willReturn($bundle);
        $slot2->getName()->willReturn('slot2');
        $slot2->getBundle()->willReturn($bundle);
        $slot3->getName()->willReturn('slot3');
        $slot3->getBundle()->willReturn($bundle);

        $slots = new ArrayCollection();
        $slots->add($slot1->getWrappedObject());
        $slots->add($slot2->getWrappedObject());
        $slots->add($slot3->getWrappedObject());

        $bundle->getSlots()->willReturn($slots);
    }

    function it_is_intializable()
    {
        $this->shouldHaveType(SlotFinder::class);
    }

    function it_implements_slot_finder_interface()
    {
        $this->shouldImplement(SlotFinderInterface::class);
    }

    function it_can_find_slot_in_bundle_by_name(
        ProductBundleInterface $bundle,
        ProductBundleSlotInterface $slot2
    ) {
        $this->findSlotInBundleByName($bundle, 'slot2')->shouldReturn($slot2);
    }

    function it_can_throw_exception_if_slot_is_not_found(
        ProductBundleInterface $bundle
    ) {
        $this->shouldThrow(SlotNotFoundException::class)->during('findSlotInBundleByName', [$bundle, 'slot4']);
    }
}
