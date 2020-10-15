<?php


namespace App\Service\Domain;


use App\Entity\PhysicalFile;
use App\Repository\PhysicalFileRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints\Date;

class PhysicalFileService
{
    private PhysicalFileRepository $fileRepository;

    private EntityManagerInterface $em;

    private string $uploadFolder;

    /**
     * PhysicalFileService constructor.
     * @param PhysicalFileRepository $fileRepository
     * @param EntityManagerInterface $em
     * @param string $uploadFolder
     */
    public function __construct(PhysicalFileRepository $fileRepository, EntityManagerInterface $em, string $uploadFolder)
    {
        $this->fileRepository = $fileRepository;
        $this->em = $em;

        $this->uploadFolder = $uploadFolder;
    }

    public function saveFile(File $file, string $filename): PhysicalFile
    {
        $physicalFile = new PhysicalFile();
        $date = new \DateTime();

        $newFilename = sprintf("%s.%s", $filename, $file->guessExtension());
        $physicalFile->setFilename($newFilename);

        $physicalFilename = sprintf("%s_%s", $date->format("Ymd_His"), $newFilename);
        $physicalFile->setPhysicalFilename($physicalFilename);

        $physicalFile->setPath($this->uploadFolder);
        $physicalFile->setType($file->getMimeType());

        try {
            $file->move($this->uploadFolder, $physicalFilename);

            $this->em->persist($physicalFile);
            $this->em->flush();
        } catch (FileException $e) {
            printf($e->getMessage());
        }

        return $physicalFile;
    }

}