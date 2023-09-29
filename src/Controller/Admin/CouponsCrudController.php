<?php

namespace App\Controller\Admin;

use App\Entity\Coupons;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;

class CouponsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Coupons::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('code', 'Code'),
            TextField::new('description', 'Description du coupon'),
            AssociationField::new('coupons_types', 'Type de coupon')
                ->setFormTypeOptions(['choice_label' => 'name']),
            Field::new('discount', 'Discount'),
            Field::new('max_usage', 'Usage Max'),
            BooleanField::new('is_valid'),
            DateTimeField::new('validity'),
            DateTimeField::new('updatedAt')->hideOnForm(),
            DateTimeField::new('createdAt')->hideOnForm(),
        ];
    }
    public function persistEntity(EntityManagerInterface $em, $entityInstance): void
    {
        if (!$entityInstance instanceof Coupons) return;

        $entityInstance->setCreatedAt(new \DateTimeImmutable());

        parent::persistEntity($em, $entityInstance);
    }
}
