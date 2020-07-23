<?php

namespace ProxyManagerGeneratedProxy\__PM__\App\Repository\ParticipantDirectorRepository;

class Generated43ac8493d1963dcb797b37fbfa7860a8 extends \App\Repository\ParticipantDirectorRepository implements
        \ProxyManager\Proxy\VirtualProxyInterface
{

    /**
     * @var bool[] map of public properties of the parent class
     */
    private static $publicProperties7b53c = [

    ];
    private static $signature43ac8493d1963dcb797b37fbfa7860a8 = 'YTo0OntzOjk6ImNsYXNzTmFtZSI7czo0NDoiQXBwXFJlcG9zaXRvcnlcUGFydGljaXBhbnREaXJlY3RvclJlcG9zaXRvcnkiO3M6NzoiZmFjdG9yeSI7czo1MDoiUHJveHlNYW5hZ2VyXEZhY3RvcnlcTGF6eUxvYWRpbmdWYWx1ZUhvbGRlckZhY3RvcnkiO3M6MTk6InByb3h5TWFuYWdlclZlcnNpb24iO3M6NDY6IjIuMi4zQDRkMTU0NzQyZTMxYzM1MTM3ZDUzNzRjOTk4ZThmODZiNTRkYjJlMmYiO3M6MTI6InByb3h5T3B0aW9ucyI7YTowOnt9fQ==';
    /**
     * @var \Closure|null initializer responsible for generating the wrapped object
     */
    private $valueHoldercba49 = null;
    /**
     * @var \Closure|null initializer responsible for generating the wrapped object
     */
    private $initializer1c8f3 = null;

    public function __construct(\App\Config\Dbo $dbo)
    {
        static $reflection;

        if (!$this->valueHoldercba49) {
            $reflection = $reflection ?: new \ReflectionClass('App\\Repository\\ParticipantDirectorRepository');
            $this->valueHoldercba49 = $reflection->newInstanceWithoutConstructor();
            unset($this->dbo);
        }

        $this->valueHoldercba49->__construct($dbo);
    }

    /**
     * Constructor for lazy initialization
     *
     * @param \Closure|null $initializer
     */
    public static function staticProxyConstructor($initializer)
    {
        static $reflection;

        $reflection = $reflection ?? $reflection = new \ReflectionClass(__CLASS__);
        $instance = $reflection->newInstanceWithoutConstructor();

        unset($instance->dbo);

        $instance->initializer1c8f3 = $initializer;

        return $instance;
    }

    public function findById(int $id): \App\Models\User
    {
        $this->initializer1c8f3 && $this->initializer1c8f3->__invoke(
                $this->valueHoldercba49,
                $this,
                'findById',
                array('id' => $id),
                $this->initializer1c8f3
        );

        return $this->valueHoldercba49->findById($id);
    }

    public function findAll()
    {
        $this->initializer1c8f3 && $this->initializer1c8f3->__invoke(
                $this->valueHoldercba49,
                $this,
                'findAll',
                array(),
                $this->initializer1c8f3
        );

        return $this->valueHoldercba49->findAll();
    }

    public function delete(int $id): int
    {
        $this->initializer1c8f3 && $this->initializer1c8f3->__invoke(
                $this->valueHoldercba49,
                $this,
                'delete',
                array('id' => $id),
                $this->initializer1c8f3
        );

        return $this->valueHoldercba49->delete($id);
    }

    public function & __get($name)
    {
        $this->initializer1c8f3 && $this->initializer1c8f3->__invoke(
                $this->valueHoldercba49,
                $this,
                '__get',
                ['name' => $name],
                $this->initializer1c8f3
        );

        if (isset(self::$publicProperties7b53c[$name])) {
            return $this->valueHoldercba49->$name;
        }

        $realInstanceReflection = new \ReflectionClass(get_parent_class($this));

        if (!$realInstanceReflection->hasProperty($name)) {
            $targetObject = $this->valueHoldercba49;

            $backtrace = debug_backtrace(false);
            trigger_error(
                    sprintf(
                            'Undefined property: %s::$%s in %s on line %s',
                            get_parent_class($this),
                            $name,
                            $backtrace[0]['file'],
                            $backtrace[0]['line']
                    ),
                    \E_USER_NOTICE
            );
            return $targetObject->$name;
            return;
        }

        $targetObject = $this->valueHoldercba49;
        $accessor = function & () use ($targetObject, $name) {
            return $targetObject->$name;
        };
        $backtrace = debug_backtrace(true);
        $scopeObject = isset($backtrace[1]['object']) ? $backtrace[1]['object'] : new \ProxyManager\Stub\EmptyClassStub(
        );
        $accessor = $accessor->bindTo($scopeObject, get_class($scopeObject));
        $returnValue = &$accessor();

        return $returnValue;
    }

    public function __set($name, $value)
    {
        $this->initializer1c8f3 && $this->initializer1c8f3->__invoke(
                $this->valueHoldercba49,
                $this,
                '__set',
                array('name' => $name, 'value' => $value),
                $this->initializer1c8f3
        );

        $realInstanceReflection = new \ReflectionClass(get_parent_class($this));

        if (!$realInstanceReflection->hasProperty($name)) {
            $targetObject = $this->valueHoldercba49;

            return $targetObject->$name = $value;
            return;
        }

        $targetObject = $this->valueHoldercba49;
        $accessor = function & () use ($targetObject, $name, $value) {
            return $targetObject->$name = $value;
        };
        $backtrace = debug_backtrace(true);
        $scopeObject = isset($backtrace[1]['object']) ? $backtrace[1]['object'] : new \ProxyManager\Stub\EmptyClassStub(
        );
        $accessor = $accessor->bindTo($scopeObject, get_class($scopeObject));
        $returnValue = &$accessor();

        return $returnValue;
    }

    public function __isset($name)
    {
        $this->initializer1c8f3 && $this->initializer1c8f3->__invoke(
                $this->valueHoldercba49,
                $this,
                '__isset',
                array('name' => $name),
                $this->initializer1c8f3
        );

        $realInstanceReflection = new \ReflectionClass(get_parent_class($this));

        if (!$realInstanceReflection->hasProperty($name)) {
            $targetObject = $this->valueHoldercba49;

            return isset($targetObject->$name);
            return;
        }

        $targetObject = $this->valueHoldercba49;
        $accessor = function () use ($targetObject, $name) {
            return isset($targetObject->$name);
        };
        $backtrace = debug_backtrace(true);
        $scopeObject = isset($backtrace[1]['object']) ? $backtrace[1]['object'] : new \ProxyManager\Stub\EmptyClassStub(
        );
        $accessor = $accessor->bindTo($scopeObject, get_class($scopeObject));
        $returnValue = $accessor();

        return $returnValue;
    }

    public function __unset($name)
    {
        $this->initializer1c8f3 && $this->initializer1c8f3->__invoke(
                $this->valueHoldercba49,
                $this,
                '__unset',
                array('name' => $name),
                $this->initializer1c8f3
        );

        $realInstanceReflection = new \ReflectionClass(get_parent_class($this));

        if (!$realInstanceReflection->hasProperty($name)) {
            $targetObject = $this->valueHoldercba49;

            unset($targetObject->$name);
            return;
        }

        $targetObject = $this->valueHoldercba49;
        $accessor = function () use ($targetObject, $name) {
            unset($targetObject->$name);
        };
        $backtrace = debug_backtrace(true);
        $scopeObject = isset($backtrace[1]['object']) ? $backtrace[1]['object'] : new \ProxyManager\Stub\EmptyClassStub(
        );
        $accessor = $accessor->bindTo($scopeObject, get_class($scopeObject));
        $returnValue = $accessor();

        return $returnValue;
    }

    public function __clone()
    {
        $this->initializer1c8f3 && $this->initializer1c8f3->__invoke(
                $this->valueHoldercba49,
                $this,
                '__clone',
                array(),
                $this->initializer1c8f3
        );

        $this->valueHoldercba49 = clone $this->valueHoldercba49;
    }

    public function __sleep()
    {
        $this->initializer1c8f3 && $this->initializer1c8f3->__invoke(
                $this->valueHoldercba49,
                $this,
                '__sleep',
                array(),
                $this->initializer1c8f3
        );

        return array('valueHoldercba49');
    }

    public function __wakeup()
    {
        unset($this->dbo);
    }

    public function setProxyInitializer(\Closure $initializer = null)
    {
        $this->initializer1c8f3 = $initializer;
    }

    public function getProxyInitializer()
    {
        return $this->initializer1c8f3;
    }

    public function initializeProxy(): bool
    {
        return $this->initializer1c8f3 && $this->initializer1c8f3->__invoke(
                        $this->valueHoldercba49,
                        $this,
                        'initializeProxy',
                        array(),
                        $this->initializer1c8f3
                );
    }

    public function isProxyInitialized(): bool
    {
        return null !== $this->valueHoldercba49;
    }

    public function getWrappedValueHolderValue(): ?object
    {
        return $this->valueHoldercba49;
    }


}
