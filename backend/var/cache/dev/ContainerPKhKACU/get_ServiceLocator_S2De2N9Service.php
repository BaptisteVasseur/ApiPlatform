<?php

namespace ContainerPKhKACU;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class get_ServiceLocator_S2De2N9Service extends App_KernelDevDebugContainer
{
    /**
     * Gets the private '.service_locator.S2De2N9' shared service.
     *
     * @return \Symfony\Component\DependencyInjection\ServiceLocator
     */
    public static function do($container, $lazyLoad = true)
    {
        return $container->privates['.service_locator.S2De2N9'] = new \Symfony\Component\DependencyInjection\Argument\ServiceLocator($container->getService ??= $container->getService(...), [
            'App\\Controller\\GetEstablishmentsByPrestataireController::__invoke' => ['privates', '.service_locator.PSwBGfE', 'get_ServiceLocator_PSwBGfEService', true],
            'App\\Controller\\TestController::someAction' => ['privates', '.service_locator.IVGqFDR', 'get_ServiceLocator_IVGqFDRService', true],
            'App\\Controller\\TestController::uploadFile' => ['privates', '.service_locator.Zx3oYFB', 'get_ServiceLocator_Zx3oYFBService', true],
            'App\\Kernel::loadRoutes' => ['privates', '.service_locator.y4_Zrx.', 'get_ServiceLocator_Y4Zrx_Service', true],
            'App\\Kernel::registerContainerConfiguration' => ['privates', '.service_locator.y4_Zrx.', 'get_ServiceLocator_Y4Zrx_Service', true],
            'kernel::loadRoutes' => ['privates', '.service_locator.y4_Zrx.', 'get_ServiceLocator_Y4Zrx_Service', true],
            'kernel::registerContainerConfiguration' => ['privates', '.service_locator.y4_Zrx.', 'get_ServiceLocator_Y4Zrx_Service', true],
            'App\\Controller\\GetEstablishmentsByPrestataireController:__invoke' => ['privates', '.service_locator.PSwBGfE', 'get_ServiceLocator_PSwBGfEService', true],
            'App\\Controller\\GetEstablishmentsByPrestataireController' => ['privates', '.service_locator.PSwBGfE', 'get_ServiceLocator_PSwBGfEService', true],
            'App\\Controller\\TestController:someAction' => ['privates', '.service_locator.IVGqFDR', 'get_ServiceLocator_IVGqFDRService', true],
            'App\\Controller\\TestController:uploadFile' => ['privates', '.service_locator.Zx3oYFB', 'get_ServiceLocator_Zx3oYFBService', true],
            'kernel:loadRoutes' => ['privates', '.service_locator.y4_Zrx.', 'get_ServiceLocator_Y4Zrx_Service', true],
            'kernel:registerContainerConfiguration' => ['privates', '.service_locator.y4_Zrx.', 'get_ServiceLocator_Y4Zrx_Service', true],
        ], [
            'App\\Controller\\GetEstablishmentsByPrestataireController::__invoke' => '?',
            'App\\Controller\\TestController::someAction' => '?',
            'App\\Controller\\TestController::uploadFile' => '?',
            'App\\Kernel::loadRoutes' => '?',
            'App\\Kernel::registerContainerConfiguration' => '?',
            'kernel::loadRoutes' => '?',
            'kernel::registerContainerConfiguration' => '?',
            'App\\Controller\\GetEstablishmentsByPrestataireController:__invoke' => '?',
            'App\\Controller\\GetEstablishmentsByPrestataireController' => '?',
            'App\\Controller\\TestController:someAction' => '?',
            'App\\Controller\\TestController:uploadFile' => '?',
            'kernel:loadRoutes' => '?',
            'kernel:registerContainerConfiguration' => '?',
        ]);
    }
}
