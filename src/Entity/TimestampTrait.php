<?php


namespace App\Entity;


use Doctrine\ORM\Mapping as ORM;

trait TimestampTrait
{
    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $changedAt;

    /**
     * @ORM\PrePersist()
     */
    public function prePersistTimestamp(): void
    {
        $this->createdAt = new \DateTime();
        $this->changedAt = new \DateTime();
    }

    /**
     * @ORM\PreUpdate()
     */
    public function preUpdateTimestamp(): void
    {
        $this->changedAt = new \DateTime();
    }


    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getChangedAt(): ?\DateTimeInterface
    {
        return $this->changedAt;
    }

    public function setChangedAt(\DateTimeInterface $changedAt): self
    {
        $this->changedAt = $changedAt;

        return $this;
    }
}