<?php

namespace App\Entity;

use App\Repository\OcrRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=OcrRepository::class)
 * @ORM\HasLifecycleCallbacks()
 */
class Ocr
{
    use TimestampTrait;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank
     */
    private $data;

    public function __toString()
    {
        $substring = substr($this->data, 0, 25);
        return strlen($this->data) > 25 ? $substring . "[...]" : $this->data;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getData(): ?string
    {
        return $this->data;
    }

    public function setData(string $data): self
    {
        $this->data = $data;

        return $this;
    }
}
