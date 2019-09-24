<?php
namespace AppBundle\Form;

use AppBundle\Entity\ReceiptItem;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReceiptItemType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Name', TextType::class)
            ->add('Price',TextType::class)
            ->add('Quantity',TextType::class)
            ->add('Duty',TextType::class)
            ->add('Save', SubmitType::class, ['label' => 'Save'])
            ->add('Add', SubmitType::class, ['label' => 'Add'])
        ;

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ReceiptItem::class,
        ]);
    }
}