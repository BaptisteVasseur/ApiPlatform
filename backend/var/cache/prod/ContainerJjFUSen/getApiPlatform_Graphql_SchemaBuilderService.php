<?php

namespace ContainerJjFUSen;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/*
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getApiPlatform_Graphql_SchemaBuilderService extends App_KernelProdContainer
{
    /*
     * Gets the private 'api_platform.graphql.schema_builder' shared service.
     *
     * @return \ApiPlatform\GraphQl\Type\SchemaBuilder
     */
    public static function do($container, $lazyLoad = true)
    {
        return $container->privates['api_platform.graphql.schema_builder'] = new \ApiPlatform\GraphQl\Type\SchemaBuilder(($container->privates['api_platform.metadata.resource.name_collection_factory.cached'] ?? self::getApiPlatform_Metadata_Resource_NameCollectionFactory_CachedService($container)), ($container->privates['api_platform.metadata.resource.metadata_collection_factory.cached'] ?? self::getApiPlatform_Metadata_Resource_MetadataCollectionFactory_CachedService($container)), new \ApiPlatform\GraphQl\Type\TypesFactory(new \Symfony\Component\DependencyInjection\Argument\ServiceLocator($container->getService ??= $container->getService(...), [
            'api_platform.graphql.iterable_type' => ['privates', 'api_platform.graphql.iterable_type', 'getApiPlatform_Graphql_IterableTypeService', true],
            'api_platform.graphql.upload_type' => ['privates', 'api_platform.graphql.upload_type', 'getApiPlatform_Graphql_UploadTypeService', true],
        ], [
            'api_platform.graphql.iterable_type' => '?',
            'api_platform.graphql.upload_type' => '?',
        ]), ['api_platform.graphql.iterable_type', 'api_platform.graphql.upload_type']), ($container->privates['api_platform.graphql.types_container'] ??= new \ApiPlatform\GraphQl\Type\TypesContainer()), ($container->privates['api_platform.graphql.fields_builder'] ?? $container->load('getApiPlatform_Graphql_FieldsBuilderService')));
    }
}
