<?php


namespace App\Form;
use App\Entity\Comment;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use \Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class CommentType
 * @package App\Form
 */
class CommentType extends AbstractType
{
    /**
     * @inheritDoc
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add("creator", NumberType::class, [
                "label" => "Pseudo : "
            ])
            ->add("content", TextareaType::class, [
                "label" => "Commentaire : "
            ]);

    }

    /**
     * @inheritDoc
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefault("dataClass", Comment::class);
    }
}