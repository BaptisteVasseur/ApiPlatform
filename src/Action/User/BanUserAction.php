<?php

declare(strict_types=1);

namespace App\Action\User;

use App\Entity\Auth\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class BanUserAction extends AbstractController
{
    public function __invoke(User $user): JsonResponse
    {
        return $this->json(['until' => new \DateTimeImmutable('+1 month')]);
    }
}
