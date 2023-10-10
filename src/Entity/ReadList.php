<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Link;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use App\Repository\ReadListRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ApiResource(
    operations: [
        new GetCollection(name: 'GetMyReadListsOperation', normalizationContext: ['groups' => ['read-readlist', 'read-readlist-full']]),
        new GetCollection(
            uriTemplate: '/users/{id}/lists',
            uriVariables: ['id' => new Link(fromClass: User::class, fromProperty: 'id', toProperty: 'createdBy')]
        ),
        new Post(
            denormalizationContext: ['groups' => ['create-readlist']],
            uriTemplate: '/users/{id}/lists',
            uriVariables: ['id' => new Link(fromClass: User::class, fromProperty: 'id', toProperty: 'createdBy')]
        ),
        new Get(normalizationContext: ['groups' => ['read-readlist-full']]),
        new Patch(denormalizationContext: ['groups' => ['update-readlist']]),
        new Delete(),
    ],
    normalizationContext: ['groups' => ['read-readlist']]
)]
#[ORM\Entity(repositoryClass: ReadListRepository::class)]
class ReadList
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Assert\NotBlank()]
    #[Groups(['create-readlist', 'read-readlist'])]
    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[Groups(['read-readlist-full'])]
    #[ORM\ManyToOne(inversedBy: 'readLists')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $createdBy = null;

    #[Groups(['update-readlist', 'read-readlist-full'])]
    #[ORM\ManyToMany(targetEntity: Book::class, inversedBy: 'readLists')]
    private Collection $books;

    public function __construct()
    {
        $this->books = new ArrayCollection();
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

    public function getCreatedBy(): ?User
    {
        return $this->createdBy;
    }

    public function setCreatedBy(?User $createdBy): static
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    /**
     * @return Collection<int, Book>
     */
    public function getBooks(): Collection
    {
        return $this->books;
    }

    public function addBook(Book $book): static
    {
        if (!$this->books->contains($book)) {
            $this->books->add($book);
        }

        return $this;
    }

    public function removeBook(Book $book): static
    {
        $this->books->removeElement($book);

        return $this;
    }
}
