<?php

namespace App\Entity;

use App\Repository\PhysicalFileRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=PhysicalFileRepository::class)
 * @ORM\HasLifecycleCallbacks()
 */
class PhysicalFile
{
    use TimestampTrait;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    private $filename;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    private $path;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank
     */
    private $type;

    /**
     * @ORM\ManyToOne(targetEntity=Document::class, inversedBy="file")
     */
    private $document;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    private $physicalFilename;

    public function __toString()
    {
        return $this->filename;
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFilename(): ?string
    {
        return $this->filename;
    }

    public function setFilename(string $filename): self
    {
        $this->filename = $filename;

        return $this;
    }

    public function getPath(): ?string
    {
        return $this->path;
    }

    public function setPath(string $path): self
    {
        $this->path = $path;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getDocument(): ?Document
    {
        return $this->document;
    }

    public function setDocument(?Document $document): self
    {
        $this->document = $document;

        return $this;
    }

    public function getPhysicalFilename(): ?string
    {
        return $this->physicalFilename;
    }

    public function setPhysicalFilename(string $physicalFilename): self
    {
        $this->physicalFilename = $physicalFilename;

        return $this;
    }
}
