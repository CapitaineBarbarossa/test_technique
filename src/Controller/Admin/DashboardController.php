<?php

namespace App\Controller\Admin;

use App\Entity\Categories;
use App\Entity\Coupons;
use App\Entity\CouponsTypes;
use App\Entity\Products;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        return $this->redirect($adminUrlGenerator->setController(ProductsCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Test Technique');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::section('Categories');
        yield MenuItem::subMenu('Actions', 'fas fa-bars')->setSubItems([
            MenuItem::linkToCrud('Add Category', 'fas fa-plus', Categories::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Show Categories', 'fas fa-eye', Categories::class)
        ]);
        yield MenuItem::section('Products');
        yield MenuItem::subMenu('Actions', 'fas fa-bars')->setSubItems([
            MenuItem::linkToCrud('Add Product', 'fas fa-plus', Products::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Show Products', 'fas fa-eye', Products::class)
        ]);
        yield MenuItem::section('Coupons');
        yield MenuItem::subMenu('Actions', 'fas fa-bars')->setSubItems([
            MenuItem::linkToCrud('Add Coupon', 'fas fa-plus', Coupons::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Show Coupons', 'fas fa-eye', Coupons::class)
        ]);
        yield MenuItem::section('CouponsTypes');
        yield MenuItem::subMenu('Actions', 'fas fa-bars')->setSubItems([
            MenuItem::linkToCrud('Add CouponsType', 'fas fa-plus', CouponsTypes::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Show CouponsTypess', 'fas fa-eye', CouponsTypes::class)
        ]);
    }
}
