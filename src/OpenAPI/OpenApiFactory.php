<?php

declare(strict_types=1);

namespace App\OpenAPI;

use ApiPlatform\OpenApi\Factory\OpenApiFactoryInterface;
use ApiPlatform\OpenApi\OpenApi;
use Symfony\Component\DependencyInjection\Attribute\AsDecorator;
use Symfony\Component\DependencyInjection\Attribute\AutowireDecorated;

#[AsDecorator(decorates: 'api_platform.openapi.factory')]
class OpenApiFactory implements OpenApiFactoryInterface
{
    public function __construct(
        #[AutowireDecorated] private readonly OpenApiFactoryInterface $decorated
    )
    {
    }

    public function __invoke(array $context = []): OpenApi
    {
        $openApi = $this->decorated->__invoke($context);

        // Do your logic here

        return $openApi;
    }
}
