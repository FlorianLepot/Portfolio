<?php

namespace FL\BlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PostType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, array('label' => 'Nom'))
            ->add('slug', null, array('label' => 'Slug'))
            ->add('teaser', null, array('label' => 'Introduction'))
            ->add('content', null, array('label' => 'Contenu', 'required' => false))
            //->add('image')
            ->add('published', null, array('label' => 'Publié ?'))
            ->add('category', 'entity', array(
                'class' => 'FLBlogBundle:PostCategory',
                'property' => 'name',
                'label' => 'Catégorie'
            ))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'FL\BlogBundle\Entity\Post'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'fl_blogbundle_post';
    }
}
