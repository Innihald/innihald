<?php


namespace App\Service\Domain;


use App\Entity\Document;
use App\Repository\DocumentRepository;

class DocumentService
{

    private DocumentRepository $documentRepository;

    /**
     * DocumentService constructor.
     * @param DocumentRepository $documentRepository
     */
    public function __construct(DocumentRepository $documentRepository)
    {
        $this->documentRepository = $documentRepository;
    }


    public function getAllDocuments(): array
    {
        return $this->documentRepository->findAll();
    }

    public function getDocumentById(int $id): Document
    {
        return $this->documentRepository->find($id);
    }
}