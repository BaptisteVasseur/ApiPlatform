<?php

namespace Proxies\__CG__\App\Entity;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class Establishment extends \App\Entity\Establishment implements \Doctrine\ORM\Proxy\InternalProxy
{
    use \Symfony\Component\VarExporter\LazyGhostTrait {
        initializeLazyObject as __load;
        setLazyObjectAsInitialized as public __setInitialized;
        isLazyObjectInitialized as private;
        createLazyGhost as private;
        resetLazyObject as private;
    }

    private const LAZY_OBJECT_PROPERTY_SCOPES = [
        "\0".parent::class."\0".'address' => [parent::class, 'address', null],
        "\0".parent::class."\0".'description' => [parent::class, 'description', null],
        "\0".parent::class."\0".'employees' => [parent::class, 'employees', null],
        "\0".parent::class."\0".'id' => [parent::class, 'id', null],
        "\0".parent::class."\0".'name' => [parent::class, 'name', null],
        "\0".parent::class."\0".'prestations' => [parent::class, 'prestations', null],
        "\0".parent::class."\0".'relateTo' => [parent::class, 'relateTo', null],
        'address' => [parent::class, 'address', null],
        'description' => [parent::class, 'description', null],
        'employees' => [parent::class, 'employees', null],
        'id' => [parent::class, 'id', null],
        'name' => [parent::class, 'name', null],
        'prestations' => [parent::class, 'prestations', null],
        'relateTo' => [parent::class, 'relateTo', null],
    ];

    public function __isInitialized(): bool
    {
        return isset($this->lazyObjectState) && $this->isLazyObjectInitialized();
    }

    public function __serialize(): array
    {
        $properties = (array) $this;
        unset($properties["\0" . self::class . "\0lazyObjectState"]);

        return $properties;
    }
}
