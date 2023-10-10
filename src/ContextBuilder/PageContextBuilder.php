<?php

namespace App\ContextBuilder;

use ApiPlatform\Serializer\SerializerContextBuilderInterface;
use App\Entity\Page;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\DependencyInjection\Attribute\AsDecorator;
use Symfony\Component\DependencyInjection\Attribute\AutowireDecorated;
use Symfony\Component\HttpFoundation\Request;

#[AsDecorator(decorates: 'api_platform.serializer.context_builder', priority: 500)]
class PageContextBuilder implements SerializerContextBuilderInterface
{
    public function __construct(
        protected Security $security,
        #[AutowireDecorated] protected SerializerContextBuilderInterface $decorated,
    )
    {
    }

    public function createFromRequest(Request $request, bool $normalization, array $extractedAttributes = null): array
    {
        $context = $this->decorated->createFromRequest($request, $normalization, $extractedAttributes);

        $hasGroups = isset($context['groups']);
        $denormalization = !$normalization;
        $user = $this->security->getUser();

        if (!$hasGroups || $denormalization || !$user) {
            return $context;
        }

        $context['groups'][] = 'read-page-logged-user';

        return $context;
    }
}
