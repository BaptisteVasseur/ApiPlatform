<?php

namespace ContainerJjFUSen;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/*
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getFeedbackRepositoryService extends App_KernelProdContainer
{
    /*
     * Gets the private 'App\Repository\FeedbackRepository' shared autowired service.
     *
     * @return \App\Repository\FeedbackRepository
     */
    public static function do($container, $lazyLoad = true)
    {
        return $container->privates['App\\Repository\\FeedbackRepository'] = new \App\Repository\FeedbackRepository(($container->services['doctrine'] ?? self::getDoctrineService($container)));
    }
}
