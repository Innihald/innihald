<?php

namespace App\Controller\Admin;

use App\Entity\Ocr;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class OcrCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Ocr::class;
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
