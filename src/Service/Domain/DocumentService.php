<?php


namespace App\Service\Domain;


use App\Entity\Document;
use App\Repository\DocumentRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Symfony\Component\HttpFoundation\File\File;

class DocumentService
{

    private DocumentRepository $documentRepository;

    private EntityManager $em;

    /**
     * DocumentService constructor.
     * @param DocumentRepository $documentRepository
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(DocumentRepository $documentRepository, EntityManagerInterface $entityManager)
    {
        $this->documentRepository = $documentRepository;
        $this->em = $entityManager;
    }


    public function getAllDocuments(): array
    {
        return $this->documentRepository->findAll();
    }

    public function getDocumentPaginator($offset): Paginator
    {
        return $this->documentRepository->getDocumentPaginator($offset);
    }

    public function getDocumentById(int $id): Document
    {
        return $this->documentRepository->find($id);
    }

    public function saveDocumentWithFile(Document $document, File $file, string $filename = "default"): Document
    {
        $this->em->persist($document);

        $this->em->flush();

        return $document;
    }
}