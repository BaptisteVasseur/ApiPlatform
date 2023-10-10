<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Link;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use App\Repository\PageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ApiResource(
    operations: [
        new GetCollection(
            uriTemplate: '/books/{book}/chapters/{chapter}/pages',
            uriVariables: [
                'book' => new Link(fromClass: Book::class, fromProperty: 'id', toProperty: 'book', toClass: Chapter::class),
                'chapter' => new Link(fromClass: Chapter::class, fromProperty: 'id', toProperty: 'chapter'),
            ],
            normalizationContext: ['groups' => ['read-page', 'read-page-full']],
        ),
        new Post(
            uriTemplate: '/books/{book}/chapters/{chapter}/pages',
            uriVariables: [
                'book' => new Link(fromClass: Book::class, fromProperty: 'id', toProperty: 'book', toClass: Chapter::class),
                'chapter' => new Link(fromClass: Chapter::class, fromProperty: 'id', toProperty: 'chapter'),
            ]
        ),
        new Patch(),
        new Delete(),
    ],
    normalizationContext: ['groups' => ['read-page']],
    denormalizationContext: ['groups' => ['write-page']],
)]
#[ORM\Entity(repositoryClass: PageRepository::class)]
class Page
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Groups(['write-page', 'read-page-logged-user'])]
    #[ORM\Column(type: Types::TEXT)]
    private ?string $content = null;

    #[Groups(['write-page', 'read-page'])]
    #[ORM\Column]
    private ?int $number = null;

    #[Groups(['write-page', 'read-page'])]
    #[ORM\ManyToOne(inversedBy: 'pages')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Chapter $chapter = null;

    #[Groups(['read-page'])]
    #[ORM\OneToMany(mappedBy: 'page', targetEntity: Annotation::class)]
    private Collection $annotations;

    public function __construct()
    {
        $this->annotations = new ArrayCollection();
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

    public function getNumber(): ?int
    {
        return $this->number;
    }

    public function setNumber(int $number): static
    {
        $this->number = $number;

        return $this;
    }

    public function getChapter(): ?Chapter
    {
        return $this->chapter;
    }

    public function setChapter(?Chapter $chapter): static
    {
        $this->chapter = $chapter;

        return $this;
    }

    /**
     * @return Collection<int, Annotation>
     */
    public function getAnnotations(): Collection
    {
        return $this->annotations;
    }

    public function addAnnotation(Annotation $annotation): static
    {
        if (!$this->annotations->contains($annotation)) {
            $this->annotations->add($annotation);
            $annotation->setPage($this);
        }

        return $this;
    }

    public function removeAnnotation(Annotation $annotation): static
    {
        if ($this->annotations->removeElement($annotation)) {
            // set the owning side to null (unless already changed)
            if ($annotation->getPage() === $this) {
                $annotation->setPage(null);
            }
        }

        return $this;
    }
}
