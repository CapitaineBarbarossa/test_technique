<?php

namespace App\Controller\Admin;

use App\Entity\Products;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ProductsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Products::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('name', 'Nom du produit'),
            TextField::new('description', 'Description du produit'),
            // Ajoutez le champ de sélection de catégorie
            AssociationField::new('categories', 'Catégorie')
                ->setFormTypeOptions(['choice_label' => 'name']),
            Field::new('priceTaxIncl', 'Prix TTC'),
            Field::new('priceTaxExcl', 'Prix HT'),
            Field::new('quantity', 'Quantité'),
            DateTimeField::new('updatedAt')->hideOnForm(),
            DateTimeField::new('createdAt')->hideOnForm(),
        ];
    }
    public function persistEntity(EntityManagerInterface $em, $entityInstance): void
    {
        if (!$entityInstance instanceof Products) return;

        $entityInstance->setCreatedAt(new \DateTimeImmutable());

        parent::persistEntity($em, $entityInstance);
    }
    
}
