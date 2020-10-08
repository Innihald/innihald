<?php

namespace App\Controller\Admin;

use App\Entity\PhysicalFile;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;

class PhysicalFileCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return PhysicalFile::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            Field::new("filename"),
            Field::new("path"),
            Field::new("type")
        ];
    }
}
