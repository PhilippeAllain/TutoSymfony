<?php

namespace App\Form;

use App\Entity\Recipe;
use Dom\Entity;
use Symfony\Component\Form\AbstractType;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormEvents;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Category;
use Symfony\Component\Validator\Constraints\Image;
class RecipeType extends AbstractType
{

    public function __construct(private FormListenerFactory $listenerFactory) 
    {
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'empty_data' => ''
            ])
            ->add('slug', TextType::class, [
                'required' => false,
            ])
            ->add('thumbnailFile', FileType::class)
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'expanded' => true,
                'choice_label' => 'name',
                
            ])
            ->add('content',  TextareaType::class, [
                'empty_data' => ''
            ])
            ->add('duration')
            ->add('save', SubmitType::class, [
                'label' => 'Envoyer',
            ])
            ->addEventListener(FormEvents::PRE_SUBMIT, $this->listenerFactory->autoSlug('title'))
            ->addEventListener(FormEvents::POST_SUBMIT, $this->listenerFactory->timestamps())
        ;
    }



    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Recipe::class,
            
        ]);
    }
}
