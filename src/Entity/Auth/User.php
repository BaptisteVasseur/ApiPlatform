<?php

namespace App\Entity\Auth;

use ApiPlatform\Doctrine\Orm\Filter\DateFilter;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\GraphQl\Query;
use ApiPlatform\Metadata\HttpOperation;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\OpenApi\Model\Example;
use ApiPlatform\OpenApi\Model\Operation;
use ApiPlatform\OpenApi\Model\RequestBody;
use ApiPlatform\OpenApi\Model\Response;
use ApiPlatform\OpenApi\Model\Schema;
use App\Action\User\BanUserAction;
use App\Entity\Blog\Comment;
use App\Entity\Blog\Publication;
use App\Entity\Shop\Product;
use App\Filters\CustomSearchFilter;
use ArrayObject;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response as HTTPResponse;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ApiResource(
    denormalizationContext: ['groups' => ['user:write']],
    normalizationContext: ['groups' => ['user:read']],
    operations: [
        new GetCollection(),
        new Post(),
        new Get(normalizationContext: ['groups' => ['user:read', 'user:read:full']]),
        new Patch(denormalizationContext: ['groups' => ['user:write:update']]),
        new HttpOperation(
            method: Request::METHOD_POST,
            uriTemplate: '/users/{id}/ban',
            controller: BanUserAction::class,
            openapi: new Operation(
                tags: ['User Management', 'User'],
                summary: 'Ban a user account',
                description: 'Ban a user for some reason',
                requestBody: new RequestBody(
                    content: new ArrayObject([
                        'application/json' => [
                            'schema' => [
                                'type' => 'object',
                                'properties' => [
                                    'reason' => ['type' => 'string'],
                                ]
                            ],
                            'example' => [
                                'reason' => 'Say insults, nsfw picture, ...',
                            ]
                        ]
                    ]),
                ),
                responses: [
                    HTTPResponse::HTTP_OK => new Response(description: 'User has been banned', content: new ArrayObject([
                        'application/json' => [
                            'schema' => [
                                'type' => 'object',
                                'properties' => [
                                    'until' => ['type' => 'string', 'format' => 'date-time'],
                                ],
                            ],
                            'example' => [
                                'until' => '2023-12-31T23:59:59Z',
                            ],
                        ]
                    ])),
                    HTTPResponse::HTTP_FORBIDDEN => new Response(description: "User can't be banned."),
                    HTTPResponse::HTTP_NOT_FOUND => new Response(description: 'User not found.'),
                    HTTPResponse::HTTP_CREATED => new Response(description: 'Ø Not used Ø'),
                    HTTPResponse::HTTP_BAD_REQUEST => new Response(description: 'Ø Not used Ø'),
                    HTTPResponse::HTTP_UNPROCESSABLE_ENTITY => new Response(description: 'Ø Not used Ø'),
                ]
            )
        ),
    ],
    graphQlOperations: [
        new Query(),
        new Query(name: 'CustomQuery', args: [
            'where' => ['type' => 'UserWhereInput'],
            'order' => ['type' => 'UserOrderInput'],
            'pagination' => ['type' => 'PaginationInput'],
        ])
    ]
)]
#[UniqueEntity(fields: ['email'])]
#[ORM\Table(name: '`user`')]
#[ORM\Entity]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    use Auth;

    #[ApiFilter(CustomSearchFilter::class)]
    #[Groups(['user:read', 'user:write:update'])]
    #[Assert\Length(min: 2)]
    #[ORM\Column(length: 255)]
    private string $name = '';

    #[Groups(['product:read', 'comment:read', 'user:read', 'user:write'])]
    #[Assert\Email]
    #[ORM\Column(length: 180, unique: true)]
    private string $email = '';

    #[ApiFilter(DateFilter::class)]
    #[Groups(['user:read'])]
    #[ORM\Column]
    private DateTimeImmutable $createdAt;

    #[ORM\OneToMany(mappedBy: 'author', targetEntity: Publication::class)]
    private Collection $posts;

    #[ORM\OneToMany(mappedBy: 'author', targetEntity: Comment::class)]
    private Collection $comments;

    #[ORM\ManyToMany(targetEntity: Product::class, mappedBy: 'buyers')]
    private Collection $products;

    public function __construct()
    {
        $this->posts = new ArrayCollection();
        $this->comments = new ArrayCollection();
        $this->products = new ArrayCollection();
        $this->createdAt = new DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;

        [$username, ] = explode('@', $email);
        $this->setName($username);
    }

    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTimeImmutable $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function getPosts(): Collection
    {
        return $this->posts;
    }

    public function addPost(Publication $post): void
    {
        if (!$this->posts->contains($post)) {
            $this->posts->add($post);
            $post->setAuthor($this);
        }
    }

    public function removePost(Publication $post): void
    {
        if ($this->posts->removeElement($post)) {
            if ($post->getAuthor() === $this) {
                $post->setAuthor(null);
            }
        }
    }

    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): void
    {
        if (!$this->comments->contains($comment)) {
            $this->comments->add($comment);
            $comment->setAuthor($this);
        }
    }

    public function removeComment(Comment $comment): void
    {
        if ($this->comments->removeElement($comment)) {
            if ($comment->getAuthor() === $this) {
                $comment->setAuthor(null);
            }
        }
    }

    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function addProduct(Product $product): void
    {
        if (!$this->products->contains($product)) {
            $this->products->add($product);
            $product->addBuyer($this);
        }
    }

    public function removeProduct(Product $product): void
    {
        if ($this->products->removeElement($product)) {
            $product->removeBuyer($this);
        }
    }

    public function hasProduct(Product $object): bool
    {
        foreach ($this->products as $product) {
            if ($product->getId() === $object->getId()) {
                return true;
            }
        }

        return false;
    }
}
