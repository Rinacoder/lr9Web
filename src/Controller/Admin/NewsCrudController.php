<?php

namespace App\Controller\Admin;

use App\Entity\News;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;

class NewsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return News::class;
    }
    public function configureFields(string $pageName): iterable
    {
        return [
            TextareaField::new('title'),
            TextareaField::new('annotation'),
            TextareaField::new('news_text'),

        ];
    }
    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
