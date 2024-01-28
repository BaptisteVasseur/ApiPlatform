<?php

namespace ContainerPKhKACU;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getGetEstablishmentByPrestataireStateProviderService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private 'App\State\GetEstablishmentByPrestataireStateProvider' shared autowired service.
     *
     * @return \App\State\GetEstablishmentByPrestataireStateProvider
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).'/src/State/GetEstablishmentByPrestataireStateProvider.php';

        $a = ($container->privates['security.helper'] ?? $container->load('getSecurity_HelperService'));

        if (isset($container->privates['App\\State\\GetEstablishmentByPrestataireStateProvider'])) {
            return $container->privates['App\\State\\GetEstablishmentByPrestataireStateProvider'];
        }

        return $container->privates['App\\State\\GetEstablishmentByPrestataireStateProvider'] = new \App\State\GetEstablishmentByPrestataireStateProvider(($container->privates['App\\Repository\\PrestataireRepository'] ?? $container->load('getPrestataireRepositoryService')), $a);
    }
}
