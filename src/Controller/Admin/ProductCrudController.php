<?php

namespace App\Controller\Admin;

use App\Entity\Product;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;

class ProductCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Product::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name'),
            TextField::new('subtitle'),
            SlugField::new('slug')->setTargetFieldName('name'), 
            TextareaField::new('description'),
            ImageField::new('illustration')
            ->SetBasePath('assets/uploads/')
            ->setUploadDir('public/assets/uploads/') 
            ->setUploadedFileNamePattern('[randomhash].[extension]')
            ->setRequired(false), 
            BooleanField::new('isBest'),
            MoneyField::new('price')->setCurrency('EUR'), // selection du type de monnaie
            AssociationField::new('category'),
        ];
    }
    
}
