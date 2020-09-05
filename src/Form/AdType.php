<?php

namespace App\Form;

use App\Entity\Ad;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdType extends AbstractType
{
    /**
     * Permet d'avoir la config de base d'un champas
     *
     * @param $label
     * @param $placeholder
     * @param array $options
     * @return array
     */

    private function getConfiguration($label,$placeholder, $options= []){

        return array_merge([
            'label'=>$label,
            'attr' => [
                'placeholder'=>$placeholder
            ]
        ], $options);
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title',
                TextType::class,
                $this->getConfiguration("Titre","Titre de l'annonce"))
            ->add('slug',
                TextType::class,
                $this->getConfiguration("Adresse web","Tapez l'adresse web (automatique)", [
                    'required'=> false]))
            ->add('coverImage',
                UrlType::class,
                $this->getConfiguration("Url de l'image principal","Image de couverture de votre bien"))
            ->add('introduction',
                TextType::class,
                $this->getConfiguration("Introduction","Description global de votre bien"))
            ->add('content',
                TextareaType::class,
                $this->getConfiguration("Description détaillée","Description détaillée de votre bien"))
            ->add('rooms',
                IntegerType::class,
                $this->getConfiguration("Nombre de chambre","Indiquez le nombre de chambre"))
            ->add('price',
                MoneyType::class,
                $this->getConfiguration("Prix par nuit","Indiquez le prix par nuit"))
            ->add(
                'images',
                CollectionType::class,
                [
                    'entry_type'=> ImageType::class,
                    'allow_add' => true
                ]


            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Ad::class,
        ]);
    }
}
