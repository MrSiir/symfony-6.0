<?php

namespace App\Admin;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\Type\ModelType;
use App\Entity\Category;

final class BlogPostAdmin extends AbstractAdmin
{

    protected function configureListFields(ListMapper $list): void
    {
        $list
            ->addIdentifier('title')
            ->add('category.name')
            ->add('draft')
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagrid): void
    {
        $datagrid
            ->add('title')
            ->add('category', null, [
                'field_type' => EntityType::class,
                'field_options' => [
                    'class' => Category::class,
                    'choice_label' => 'name',
                ],
            ])
        ;
    }

    protected function configureFormFields(FormMapper $form): void
    {
        $form
            ->with('Content', ['class' => 'col-md-9'])
                ->add('title', TextType::class)
                ->add('body', TextareaType::class)
            ->end()
            ->with('Meta data', ['class' => 'col-md-3'])
                ->add('category', ModelType::class, [
                    'class' => Category::class,
                    'property' => 'name',
                ])
            ->end()
        ;
    }

    public function toString(object $object): string
    {
        return $object instanceof BlogPost
            ? $object->getTitle()
            : 'Blog Post';
    }
}