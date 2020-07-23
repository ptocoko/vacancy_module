<?php

namespace ProxyManagerGeneratedProxy\__PM__\App\Repository\VacancyResponseRepository;

class Generated58569fc2b857ff7c455c1b0197df16c2 extends \App\Repository\VacancyResponseRepository implements
        \ProxyManager\Proxy\VirtualProxyInterface
{

    /**
     * @var bool[] map of public properties of the parent class
     */
    private static $publicProperties7b53c = [

    ];
    private static $signature58569fc2b857ff7c455c1b0197df16c2 = 'YTo0OntzOjk6ImNsYXNzTmFtZSI7czo0MDoiQXBwXFJlcG9zaXRvcnlcVmFjYW5jeVJlc3BvbnNlUmVwb3NpdG9yeSI7czo3OiJmYWN0b3J5IjtzOjUwOiJQcm94eU1hbmFnZXJcRmFjdG9yeVxMYXp5TG9hZGluZ1ZhbHVlSG9sZGVyRmFjdG9yeSI7czoxOToicHJveHlNYW5hZ2VyVmVyc2lvbiI7czo0NjoiMi4yLjNANGQxNTQ3NDJlMzFjMzUxMzdkNTM3NGM5OThlOGY4NmI1NGRiMmUyZiI7czoxMjoicHJveHlPcHRpb25zIjthOjA6e319';
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
            $reflection = $reflection ?: new \ReflectionClass('App\\Repository\\VacancyResponseRepository');
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

    public function findByVacancyId($vacancyId): array
    {
        $this->initializer1c8f3 && $this->initializer1c8f3->__invoke(
                $this->valueHoldercba49,
                $this,
                'findByVacancyId',
                array('vacancyId' => $vacancyId),
                $this->initializer1c8f3
        );

        return $this->valueHoldercba49->findByVacancyId($vacancyId);
    }

    public function countOfResponsesWith(int $userId, int $vacancyId): array
    {
        $this->initializer1c8f3 && $this->initializer1c8f3->__invoke(
                $this->valueHoldercba49,
                $this,
                'countOfResponsesWith',
                array(
                        'userId' => $userId,
                        'vacancyId' => $vacancyId
                ),
                $this->initializer1c8f3
        );

        return $this->valueHoldercba49->countOfResponsesWith($userId, $vacancyId);
    }

    public function saveResponse(
            int $vacancyId,
            int $userId,
            string $responseDate,
            string $responseComment,
            string $responseDay
    ): int {
        $this->initializer1c8f3 && $this->initializer1c8f3->__invoke(
                $this->valueHoldercba49,
                $this,
                'saveResponse',
                array(
                        'vacancyId' => $vacancyId,
                        'userId' => $userId,
                        'responseDate' => $responseDate,
                        'responseComment' => $responseComment,
                        'responseDay' => $responseDay
                ),
                $this->initializer1c8f3
        );

        return $this->valueHoldercba49->saveResponse(
                $vacancyId,
                $userId,
                $responseDate,
                $responseComment,
                $responseDay
        );
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
