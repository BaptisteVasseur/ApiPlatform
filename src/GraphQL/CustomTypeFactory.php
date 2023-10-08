<?php

declare(strict_types=1);

namespace App\GraphQL;

use ApiPlatform\GraphQl\Type\TypesFactoryInterface;
use GraphQL\Utils\BuildSchema;
use Symfony\Component\DependencyInjection\Attribute\AsDecorator;
use Symfony\Component\DependencyInjection\Attribute\AutowireDecorated;

#[AsDecorator(decorates: 'api_platform.graphql.types_factory', priority: 1000)]
class CustomTypeFactory implements TypesFactoryInterface
{
    public function __construct(
        #[AutowireDecorated] protected TypesFactoryInterface $decorated,
    )
    {}

    public function getTypes(): array
    {
        $types = $this->decorated->getTypes();

        $content1 = file_get_contents(__DIR__ . '/input.graphql');
        $content2 = file_get_contents(__DIR__ . '/entities.graphql');
        $schema = BuildSchema::build($content1 . ' ' . $content2);

        $fileTypes = $schema->getConfig()->getTypes()();

        return array_merge($types, $fileTypes);
    }
}
