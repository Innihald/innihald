<?php

namespace App\Entity;

use App\Repository\DocumentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=DocumentRepository::class)
 * @ORM\HasLifecycleCallbacks()
 */
class Document
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
    private $title;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\OneToOne(targetEntity=Ocr::class, cascade={"persist", "remove"})
     */
    private $ocr;

    /**
     * @ORM\OneToMany(targetEntity=PhysicalFile::class, mappedBy="document")
     */
    private $file;

    public function __construct()
    {
        $this->file = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getOcr(): ?Ocr
    {
        return $this->ocr;
    }

    public function setOcr(?Ocr $ocr): self
    {
        $this->ocr = $ocr;

        return $this;
    }

    /**
     * @return Collection|PhysicalFile[]
     */
    public function getFile(): Collection
    {
        return $this->file;
    }

    public function addFile(PhysicalFile $file): self
    {
        if (!$this->file->contains($file)) {
            $this->file[] = $file;
            $file->setDocument($this);
        }

        return $this;
    }

    public function removeFile(PhysicalFile $file): self
    {
        if ($this->file->contains($file)) {
            $this->file->removeElement($file);
            // set the owning side to null (unless already changed)
            if ($file->getDocument() === $this) {
                $file->setDocument(null);
            }
        }

        return $this;
    }
}
