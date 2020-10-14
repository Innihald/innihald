<?php

namespace App\Controller;

use App\Entity\Document;
use App\Form\DocumentFormType;
use App\Form\DocumentUploadFormType;
use App\Form\FileUploadFormType;
use App\Repository\DocumentRepository;
use App\Service\Domain\DocumentService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;
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
     * @param Request $request
     * @return Response
     */
    public function index(Request $request): Response
    {
        $offset = max(0, $request->query->getInt('offset', 0));
        $paginator = $this->documentService->getDocumentPaginator($offset);

        return $this->render('document/index.html.twig', [
            'documents' => $paginator,
            'previous' => $offset - DocumentRepository::PAGINATOR_PER_PAGE,
            'next' => min(count($paginator), $offset + DocumentRepository::PAGINATOR_PER_PAGE)
        ]);
    }

    /**
     * @Route("/document/new", name="document_new")
     * @param Request $request
     * @return Response
     */
    public function create(Request $request): Response
    {
        $documentUploadForm = $this->createForm(DocumentUploadFormType::class);

        $documentUploadForm->handleRequest($request);

        if ($documentUploadForm->isSubmitted() && $documentUploadForm->isValid()) {

            $document = new Document();

            /** @var Form $documentForm */
            $documentForm = $documentUploadForm["document"];
            /** @var Form $fileForm */
            $fileForm = $documentUploadForm["file"];

            $document->setTitle($documentForm["title"]->getData());
            $document->setDescription($documentForm["description"]->getData());

            $document = $this->documentService->saveDocumentWithFile($document, $fileForm["file"]->getData(), $fileForm["filename"]->getData());

            dump($document);

            return $this->redirectToRoute('document_show', ['id' => $document->getId()]);
        }

        return $this->render('document/create.html.twig', [
            'documentupload_form' => $documentUploadForm->createView(),
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
