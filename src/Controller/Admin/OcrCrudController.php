<?php

namespace App\Controller\Admin;

use App\Entity\Ocr;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;

class OcrCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Ocr::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            Field::new("data")
        ];
    }
}
