<?php

namespace App\Controller\Admin;

use App\Entity\Document;
use App\Entity\Ocr;
use App\Entity\PhysicalFile;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Innihald DMS');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');

        yield MenuItem::section("Document Management");
        yield MenuItem::linkToCrud("Documents", "fa fa-folder", Document::class);
        yield MenuItem::linkToCrud("Files", "fa fa-file", PhysicalFile::class);
        yield MenuItem::linkToCrud("OCR", "fa fa-paragraph", Ocr::class);

        yield MenuItem::section("User Management");
        yield MenuItem::linkToCrud('User', 'fa fa-users', User::class);

        yield MenuItem::linkToUrl('Visit public website', null, '/');
        //yield MenuItem::linkToLogout('Logout', 'fa fa-exit');
    }
}
