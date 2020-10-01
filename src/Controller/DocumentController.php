<?php

namespace App\Controller;

use App\Entity\Document;
use App\Service\Domain\DocumentService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DocumentController extends AbstractController
{

    private DocumentService $documentService;

    /**
     * DocumentController constructor.
     * @param DocumentService $documentService
     */
    public function __construct(DocumentService $documentService)
    {
        $this->documentService = $documentService;
    }

    /**
     * @Route("/document", name="document")
     */
    public function index(): Response
    {
        return $this->render('document/index.html.twig', [
            'documents' => $this->documentService->getAllDocuments(),
        ]);
    }

    /**
     * @Route("/document/{id}", name="document_show")
     * @param Document $document
     * @return Response
     */
    public function show(Document $document): Response
    {
        return $this->render('document/show.html.twig', [
            'document' => $document
        ]);
    }
}
