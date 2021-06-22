<?php

namespace App\Form;
use App\Entity\Game;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use \Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class ResearchType
 * @package App\Form
 */
class ResearchType extends AbstractType
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
                "label" => "Nom du jeu : "
            ])
            ->add("category", ChoiceType::class, [
                "label" => "Catégorie : ",
                "choices" => [
                    "R-18 Game" => "R-18 Game",
                    "Horreur" => "Horreur",
                    "Fantasy" => "Fantasy"
                ]
            ])
        ->add("genre", ChoiceType::class, [
            "label" => "Genre : ",
            "choices" => [
                "RPG" => "RPG",
                "Tower Defense" => "Tower Defense",
                "FPS" => "FPS"
            ]
        ]);
    }

    /**
     * @inheritDoc
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefault("dataClass", Game::class);
    }
}