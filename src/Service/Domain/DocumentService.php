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

    private EntityManagerInterface $em;

    private PhysicalFileService $physicalFileService;

    /**
     * DocumentService constructor.
     * @param DocumentRepository $documentRepository
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(DocumentRepository $documentRepository, EntityManagerInterface $entityManager, PhysicalFileService $physicalFileService)
    {
        $this->documentRepository = $documentRepository;
        $this->em = $entityManager;

        $this->physicalFileService = $physicalFileService;
    }


    public function getAllDocuments(): array
    {
        return $this->documentRepository->findAll();
    }

    public function getDocumentPaginator(int $offset): Paginator
    {
        return $this->documentRepository->getDocumentPaginator($offset);
    }

    /**
     * @param int $id
     * @return Document|null
     */
    public function getDocumentById(int $id): Document
    {
        return $this->documentRepository->find($id);
    }

    public function saveDocumentWithFile(Document $document, File $file, string $filename = ""): Document
    {
        $filename = $filename !== "" ? $filename : $file->getFilename();

        $physicalFile = $this->physicalFileService->saveFile($file, $filename);

        $document->addFile($physicalFile);

        $this->em->persist($document);
        $this->em->flush();

        return $document;
    }
}