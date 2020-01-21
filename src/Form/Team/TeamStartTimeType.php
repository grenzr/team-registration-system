<?php

namespace App\Form\Team;

use App\Entity\Hike;
use App\Entity\Team;
use App\Repository\HikeRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TeamStartTimeType extends AbstractType
{

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('teamNumber', TextType::class)
            ->add('startTime', DateTimeType::class, [
                'widget' => 'single_text',
                'attr' => ['class' => 'js-datetimepicker'],
                'html5' => false,
                'format' => 'dd/MM/yyyy HH:mm'
            ])
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Team::class
        ]);
    }
}
