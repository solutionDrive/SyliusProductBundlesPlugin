<?php

declare(strict_types=1);

/*
 * Created by solutionDrive GmbH
 *
 * @copyright 2018 solutionDrive GmbH
 */

namespace solutionDrive\SyliusProductBundlesPlugin\Form\Type;

use solutionDrive\SyliusProductBundlesPlugin\Entity\ProductBundleInterface;
use solutionDrive\SyliusProductBundlesPlugin\Entity\ProductBundleSlot;
use solutionDrive\SyliusProductBundlesPlugin\Entity\ProductBundleSlotInterface;
use Sylius\Bundle\ProductBundle\Form\Type\ProductAutocompleteChoiceType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class ProductBundleSlotType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'sylius.ui.name',
                'constraints' => [new NotBlank()],
            ])
            ->add('products', ProductAutocompleteChoiceType::class, [
                'label' => 'sylius.ui.products',
                'multiple' => true,
                'by_reference' => false,
                'required' => false,
            ])
            ->add('position', IntegerType::class, [
                'label' => 'solutiondrive.ui.position',
                'required' => false,
            ])
            ->add('isPresentationSlot', CheckboxType::class, [
                'label' => 'solutiondrive.ui.presentation_slot',
                'mapped' => false,
                'attr' => ['data-qa' => 'presentation-slot'],
            ])
            ->addEventListener(FormEvents::POST_SET_DATA, function (FormEvent $event): void {
                /** @var ProductBundleSlotInterface $slot */
                $slot = $event->getData();
                if (null == $slot || null === $slot->getBundle()) {
                    return;
                }
                $event->getForm()->get('isPresentationSlot')->setData($slot->isPresentationSlot());
            })
            ->addEventListener(FormEvents::POST_SUBMIT, function (FormEvent $event): void {
                $isPresentationSlot = $event->getForm()->get('isPresentationSlot')->getData();
                /** @var ProductBundleSlotInterface $slot */
                $slot = $event->getData();
                /** @var ProductBundleInterface $bundle */
                $bundle = $event->getForm()->getParent()->getParent()->getData();
                if (null == $bundle) {
                    return;
                }
                if (true === $isPresentationSlot) {
                    $bundle->setPresentationSlot($slot);
                } elseif ($bundle->getPresentationSlot() === $slot) {
                    $bundle->setPresentationSlot(null);
                }
            });
    }

    public function getBlockPrefix(): string
    {
        return 'product_bundle_slot';
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ProductBundleSlot::class,
        ]);
    }
}
