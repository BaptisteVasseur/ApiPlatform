<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use App\Repository\BookRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ApiResource(
    operations: [
        new GetCollection(),
        new Post(),
        new Get(normalizationContext: ['groups' => ['read-book-all']]),
        new Delete(),
        new Patch(),
    ],
    denormalizationContext: ['groups' => ['create-book']],
    normalizationContext: ['groups' => ['read-book']],
)]
#[ORM\Entity(repositoryClass: BookRepository::class)]
class Book
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Groups(['read-readlist', 'create-book', 'read-book'])]
    #[Assert\NotBlank()]
    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[Groups(['read-book-all'])]
    #[ORM\Column]
    private \DateTimeImmutable $createdAt;

    #[Groups(['read-book-all'])]
    #[ORM\ManyToOne(inversedBy: 'books')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $createdBy = null;

    #[Groups(['read-readlist', 'create-book', 'read-book'])]
    #[ORM\Column]
    private array $categories = [];

    #[Groups(['read-book-all'])]
    #[ORM\OneToMany(mappedBy: 'book', targetEntity: Chapter::class)]
    private Collection $chapters;

    #[Groups(['read-book-all'])]
    #[ORM\OneToMany(mappedBy: 'book', targetEntity: Review::class)]
    private Collection $reviews;

    #[ORM\ManyToMany(targetEntity: ReadList::class, mappedBy: 'books')]
    private Collection $readLists;

    public function __construct()
    {
        $this->chapters = new ArrayCollection();
        $this->reviews = new ArrayCollection();
        $this->readLists = new ArrayCollection();

        $this->createdAt = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

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

    public function getCategories(): array
    {
        return $this->categories;
    }

    public function setCategories(array $categories): static
    {
        $this->categories = $categories;

        return $this;
    }

    /**
     * @return Collection<int, Chapter>
     */
    public function getChapters(): Collection
    {
        return $this->chapters;
    }

    public function addChapter(Chapter $chapter): static
    {
        if (!$this->chapters->contains($chapter)) {
            $this->chapters->add($chapter);
            $chapter->setBook($this);
        }

        return $this;
    }

    public function removeChapter(Chapter $chapter): static
    {
        if ($this->chapters->removeElement($chapter)) {
            // set the owning side to null (unless already changed)
            if ($chapter->getBook() === $this) {
                $chapter->setBook(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Review>
     */
    public function getReviews(): Collection
    {
        return $this->reviews;
    }

    public function addReview(Review $review): static
    {
        if (!$this->reviews->contains($review)) {
            $this->reviews->add($review);
            $review->setBook($this);
        }

        return $this;
    }

    public function removeReview(Review $review): static
    {
        if ($this->reviews->removeElement($review)) {
            // set the owning side to null (unless already changed)
            if ($review->getBook() === $this) {
                $review->setBook(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ReadList>
     */
    public function getReadLists(): Collection
    {
        return $this->readLists;
    }

    public function addReadList(ReadList $readList): static
    {
        if (!$this->readLists->contains($readList)) {
            $this->readLists->add($readList);
            $readList->addBook($this);
        }

        return $this;
    }

    public function removeReadList(ReadList $readList): static
    {
        if ($this->readLists->removeElement($readList)) {
            $readList->removeBook($this);
        }

        return $this;
    }
}
