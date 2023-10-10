<?php

namespace App\Normalizer;

use App\Entity\Review;
use App\Entity\User;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\DependencyInjection\Attribute\AsDecorator;
use Symfony\Component\DependencyInjection\Attribute\AutowireDecorated;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Serializer\Normalizer\ContextAwareNormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class ReviewNormalizer implements NormalizerInterface, NormalizerAwareInterface
{
    use NormalizerAwareTrait;

    private const ALREADY_CALLED = 'REVIEW_NORMALIZER_ALREADY_CALLED';


    public function __construct(
        protected Security $security,
    ) {}

    public function supportsNormalization(mixed $data, string $format = null, array $context = []): bool
    {
        if (isset($context[self::ALREADY_CALLED])) {
            return false;
        }

        return $data instanceof Review;
    }

    public function normalize(mixed $object, string $format = null, array $context = []): mixed
    {
        $norm = $this->normalizer;

        /** @var Review $object */

        /** @var User $loggedUser */
        $loggedUser = $this->security->getUser();

        if ($loggedUser && $object->getCreatedBy()->getId() === $loggedUser->getId()) {
            $context['groups'][] = 'read-my-review';
        }

        $context[self::ALREADY_CALLED] = true;

        return $this->normalizer->normalize($object, $format, $context);
    }
}
