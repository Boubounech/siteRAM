<?php


namespace App\Form;
use App\Entity\Game;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use \Symfony\Component\Form\AbstractType;

class GameType extends AbstractType
{
    /**
     * @inheritDoc
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add("name", TextType::class, [
                "label" => "Nom : "
            ])
            ->add("link", TextType::class, [
                "label" => "Lien de téléchargement : "
            ])
            ->add("category", ChoiceType::class, [
                "label" => "Catégorie : ",
                "choices" => [
                    "R-18 Games" => "R-18 Games",
                    "Familial" => "Familial",
                    "Science-Fiction" => "Science-Fiction",
                    "Historique" => "Historique"
                ]
            ])
            ->add("genre", ChoiceType::class, [
                "label" => "Genre : ",
                "choices" => [
                    "RPG" => "RPG",
                    "FPS" => "FPS",
                    "Tower Defense" => "Tower Defense",
                    "Jeu de Cartes" => "Jeu de Cartes",
                    "Light Novel" => "Light Novel"
                ]
            ]);
    }

    /**
     * @inheritDoc
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefault("dataClass", Game::class);
    }
}