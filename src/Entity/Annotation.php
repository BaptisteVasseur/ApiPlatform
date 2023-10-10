<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Link;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use App\Repository\AnnotationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ApiResource(
    operations: [
        new Post(
            uriTemplate: '/pages/{id}/annotations',
            uriVariables: [
                'id' => new Link(fromClass: Page::class, fromProperty: 'id', toProperty: 'page')
            ],
        ),
        new Delete(),
        new Patch(),
    ]
)]
#[ORM\Entity(repositoryClass: AnnotationRepository::class)]
class Annotation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Groups(['read-page-full'])]
    #[ORM\Column(type: Types::TEXT)]
    private ?string $content = null;

    #[ORM\Column]
    private \DateTimeImmutable $createdAt;

    #[ORM\ManyToOne(inversedBy: 'annotations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $createdBy = null;

    #[Groups(['read-page-full'])]
    #[ORM\ManyToOne(inversedBy: 'annotations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Page $page = null;

    #[Groups(['read-page-full'])]
    #[ORM\Column]
    private ?int $line = null;

    #[Groups(['read-page-full'])]
    #[ORM\Column]
    private ?int $word = null;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): static
    {
        $this->content = $content;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getCreatedBy(): ?User
    {
        return $this->createdBy;
    }

    public function setCreatedBy(?User $createdBy): static
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    public function getPage(): ?Page
    {
        return $this->page;
    }

    public function setPage(?Page $page): static
    {
        $this->page = $page;

        return $this;
    }

    public function getLine(): ?int
    {
        return $this->line;
    }

    public function setLine(int $line): static
    {
        $this->line = $line;

        return $this;
    }

    public function getWord(): ?int
    {
        return $this->word;
    }

    public function setWord(int $word): static
    {
        $this->word = $word;

        return $this;
    }
}
