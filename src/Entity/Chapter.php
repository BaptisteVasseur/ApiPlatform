<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Link;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use App\Repository\ChapterRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ApiResource(
    operations: [
        new GetCollection(
            uriTemplate: '/books/{id}/chapters',
            uriVariables: [
                'id' => new Link(fromClass: Book::class, fromProperty: 'id', toProperty: 'book')
            ]
        ),
        new Post(
            uriTemplate: '/books/{id}/chapters',
            uriVariables: [
                'id' => new Link(fromClass: Book::class, fromProperty: 'id', toProperty: 'book')
            ],
            denormalizationContext: ['groups' => ['create-chapter']]
        ),
        new Patch(denormalizationContext: ['groups' => ['update-chapter']]),
        new Delete(),
    ],
    normalizationContext: ['groups' => ['read-chapter']]
)]
#[ORM\Entity(repositoryClass: ChapterRepository::class)]
class Chapter
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Assert\NotBlank()]
    #[Groups(['create-chapter', 'update-chapter', 'read-chapter', 'read-book-all'])]
    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[Groups(['create-chapter'])]
    #[ORM\ManyToOne(inversedBy: 'chapters')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Book $book = null;

    #[Groups(['read-chapter', 'read-book-all'])]
    #[ORM\OneToMany(mappedBy: 'chapter', targetEntity: Page::class)]
    private Collection $pages;

    public function __construct()
    {
        $this->pages = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getBook(): ?Book
    {
        return $this->book;
    }

    public function setBook(?Book $book): static
    {
        $this->book = $book;

        return $this;
    }

    /**
     * @return Collection<int, Page>
     */
    public function getPages(): Collection
    {
        return $this->pages;
    }

    public function addPage(Page $page): static
    {
        if (!$this->pages->contains($page)) {
            $this->pages->add($page);
            $page->setChapter($this);
        }

        return $this;
    }

    public function removePage(Page $page): static
    {
        if ($this->pages->removeElement($page)) {
            // set the owning side to null (unless already changed)
            if ($page->getChapter() === $this) {
                $page->setChapter(null);
            }
        }

        return $this;
    }
}
