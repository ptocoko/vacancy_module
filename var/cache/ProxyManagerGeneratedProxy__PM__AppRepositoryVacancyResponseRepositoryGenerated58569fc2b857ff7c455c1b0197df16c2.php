<?php

namespace ProxyManagerGeneratedProxy\__PM__\App\Repository\VacancyResponseRepository;

use App\Core\Dbo;
use App\Repository\VacancyResponseRepository;
use Closure;
use ProxyManager\Proxy\VirtualProxyInterface;
use ProxyManager\Stub\EmptyClassStub;
use ReflectionClass;

use const E_USER_NOTICE;

class Generated58569fc2b857ff7c455c1b0197df16c2 extends VacancyResponseRepository implements VirtualProxyInterface
{

    /**
     * @var bool[] map of public properties of the parent class
     */
    private static $publicPropertiesd47f5 = [

    ];
    private static $signature58569fc2b857ff7c455c1b0197df16c2 = 'YTo0OntzOjk6ImNsYXNzTmFtZSI7czo0MDoiQXBwXFJlcG9zaXRvcnlcVmFjYW5jeVJlc3BvbnNlUmVwb3NpdG9yeSI7czo3OiJmYWN0b3J5IjtzOjUwOiJQcm94eU1hbmFnZXJcRmFjdG9yeVxMYXp5TG9hZGluZ1ZhbHVlSG9sZGVyRmFjdG9yeSI7czoxOToicHJveHlNYW5hZ2VyVmVyc2lvbiI7czo0NjoiMi4yLjNANGQxNTQ3NDJlMzFjMzUxMzdkNTM3NGM5OThlOGY4NmI1NGRiMmUyZiI7czoxMjoicHJveHlPcHRpb25zIjthOjA6e319';
    /**
     * @var Closure|null initializer responsible for generating the wrapped object
     */
    private $valueHolder0242b = null;
    /**
     * @var Closure|null initializer responsible for generating the wrapped object
     */
    private $initializer12ad8 = null;

    public function __construct(Dbo $dbo)
    {
        static $reflection;

        if (!$this->valueHolder0242b) {
            $reflection = $reflection ?: new ReflectionClass('App\\Repository\\VacancyResponseRepository');
            $this->valueHolder0242b = $reflection->newInstanceWithoutConstructor();
            unset($this->dbo);
        }

        $this->valueHolder0242b->__construct($dbo);
    }

    /**
     * Constructor for lazy initialization
     *
     * @param Closure|null $initializer
     */
    public static function staticProxyConstructor($initializer)
    {
        static $reflection;

        $reflection = $reflection ?? $reflection = new ReflectionClass(__CLASS__);
        $instance = $reflection->newInstanceWithoutConstructor();

        unset($instance->dbo);

        $instance->initializer12ad8 = $initializer;

        return $instance;
    }

    public function findById(int $id): array
    {
        $this->initializer12ad8 && $this->initializer12ad8->__invoke(
                $this->valueHolder0242b,
                $this,
                'findById',
                array('id' => $id),
                $this->initializer12ad8
        );

        return $this->valueHolder0242b->findById($id);
    }

    public function findByVacancyId($vacancyId): array
    {
        $this->initializer12ad8 && $this->initializer12ad8->__invoke(
                $this->valueHolder0242b,
                $this,
                'findByVacancyId',
                array('vacancyId' => $vacancyId),
                $this->initializer12ad8
        );

        return $this->valueHolder0242b->findByVacancyId($vacancyId);
    }

    public function countOfResponsesWith(int $userId, int $vacancyId): int
    {
        $this->initializer12ad8 && $this->initializer12ad8->__invoke(
                $this->valueHolder0242b,
                $this,
                'countOfResponsesWith',
                array(
                        'userId' => $userId,
                        'vacancyId' => $vacancyId
                ),
                $this->initializer12ad8
        );

        return $this->valueHolder0242b->countOfResponsesWith($userId, $vacancyId);
    }

    public function saveResponse(
            int $vacancyId,
            int $userId,
            int $responseDate,
            string $responseComment,
            string $responseDay
    ): int {
        $this->initializer12ad8 && $this->initializer12ad8->__invoke(
                $this->valueHolder0242b,
                $this,
                'saveResponse',
                array(
                        'vacancyId' => $vacancyId,
                        'userId' => $userId,
                        'responseDate' => $responseDate,
                        'responseComment' => $responseComment,
                        'responseDay' => $responseDay
                ),
                $this->initializer12ad8
        );

        return $this->valueHolder0242b->saveResponse(
                $vacancyId,
                $userId,
                $responseDate,
                $responseComment,
                $responseDay
        );
    }

    public function setAccepted(int $responseId): void
    {
        $this->initializer12ad8 && $this->initializer12ad8->__invoke(
                $this->valueHolder0242b,
                $this,
                'setAccepted',
                array('responseId' => $responseId),
                $this->initializer12ad8
        );

        $this->valueHolder0242b->setAccepted($responseId);
        return;
    }

    public function findResponsesByUser(int $userId): array
    {
        $this->initializer12ad8 && $this->initializer12ad8->__invoke(
                $this->valueHolder0242b,
                $this,
                'findResponsesByUser',
                array('userId' => $userId),
                $this->initializer12ad8
        );

        return $this->valueHolder0242b->findResponsesByUser($userId);
    }

    public function findAll(): array
    {
        $this->initializer12ad8 && $this->initializer12ad8->__invoke(
                $this->valueHolder0242b,
                $this,
                'findAll',
                array(),
                $this->initializer12ad8
        );

        return $this->valueHolder0242b->findAll();
    }

    public function delete(int $id): int
    {
        $this->initializer12ad8 && $this->initializer12ad8->__invoke(
                $this->valueHolder0242b,
                $this,
                'delete',
                array('id' => $id),
                $this->initializer12ad8
        );

        return $this->valueHolder0242b->delete($id);
    }

    public function & __get($name)
    {
        $this->initializer12ad8 && $this->initializer12ad8->__invoke(
                $this->valueHolder0242b,
                $this,
                '__get',
                ['name' => $name],
                $this->initializer12ad8
        );

        if (isset(self::$publicPropertiesd47f5[$name])) {
            return $this->valueHolder0242b->$name;
        }

        $realInstanceReflection = new ReflectionClass(get_parent_class($this));

        if (!$realInstanceReflection->hasProperty($name)) {
            $targetObject = $this->valueHolder0242b;

            $backtrace = debug_backtrace(false);
            trigger_error(
                    sprintf(
                            'Undefined property: %s::$%s in %s on line %s',
                            get_parent_class($this),
                            $name,
                            $backtrace[0]['file'],
                            $backtrace[0]['line']
                    ),
                    E_USER_NOTICE
            );
            return $targetObject->$name;
            return;
        }

        $targetObject = $this->valueHolder0242b;
        $accessor = function & () use ($targetObject, $name) {
            return $targetObject->$name;
        };
        $backtrace = debug_backtrace(true);
        $scopeObject = isset($backtrace[1]['object']) ? $backtrace[1]['object'] : new EmptyClassStub();
        $accessor = $accessor->bindTo($scopeObject, get_class($scopeObject));
        $returnValue = &$accessor();

        return $returnValue;
    }

    public function __set($name, $value)
    {
        $this->initializer12ad8 && $this->initializer12ad8->__invoke(
                $this->valueHolder0242b,
                $this,
                '__set',
                array('name' => $name, 'value' => $value),
                $this->initializer12ad8
        );

        $realInstanceReflection = new ReflectionClass(get_parent_class($this));

        if (!$realInstanceReflection->hasProperty($name)) {
            $targetObject = $this->valueHolder0242b;

            return $targetObject->$name = $value;
            return;
        }

        $targetObject = $this->valueHolder0242b;
        $accessor = function & () use ($targetObject, $name, $value) {
            return $targetObject->$name = $value;
        };
        $backtrace = debug_backtrace(true);
        $scopeObject = isset($backtrace[1]['object']) ? $backtrace[1]['object'] : new EmptyClassStub();
        $accessor = $accessor->bindTo($scopeObject, get_class($scopeObject));
        $returnValue = &$accessor();

        return $returnValue;
    }

    public function __isset($name)
    {
        $this->initializer12ad8 && $this->initializer12ad8->__invoke(
                $this->valueHolder0242b,
                $this,
                '__isset',
                array('name' => $name),
                $this->initializer12ad8
        );

        $realInstanceReflection = new ReflectionClass(get_parent_class($this));

        if (!$realInstanceReflection->hasProperty($name)) {
            $targetObject = $this->valueHolder0242b;

            return isset($targetObject->$name);
            return;
        }

        $targetObject = $this->valueHolder0242b;
        $accessor = function () use ($targetObject, $name) {
            return isset($targetObject->$name);
        };
        $backtrace = debug_backtrace(true);
        $scopeObject = isset($backtrace[1]['object']) ? $backtrace[1]['object'] : new EmptyClassStub();
        $accessor = $accessor->bindTo($scopeObject, get_class($scopeObject));
        $returnValue = $accessor();

        return $returnValue;
    }

    public function __unset($name)
    {
        $this->initializer12ad8 && $this->initializer12ad8->__invoke(
                $this->valueHolder0242b,
                $this,
                '__unset',
                array('name' => $name),
                $this->initializer12ad8
        );

        $realInstanceReflection = new ReflectionClass(get_parent_class($this));

        if (!$realInstanceReflection->hasProperty($name)) {
            $targetObject = $this->valueHolder0242b;

            unset($targetObject->$name);
            return;
        }

        $targetObject = $this->valueHolder0242b;
        $accessor = function () use ($targetObject, $name) {
            unset($targetObject->$name);
        };
        $backtrace = debug_backtrace(true);
        $scopeObject = isset($backtrace[1]['object']) ? $backtrace[1]['object'] : new EmptyClassStub();
        $accessor = $accessor->bindTo($scopeObject, get_class($scopeObject));
        $returnValue = $accessor();

        return $returnValue;
    }

    public function __clone()
    {
        $this->initializer12ad8 && $this->initializer12ad8->__invoke(
                $this->valueHolder0242b,
                $this,
                '__clone',
                array(),
                $this->initializer12ad8
        );

        $this->valueHolder0242b = clone $this->valueHolder0242b;
    }

    public function __sleep()
    {
        $this->initializer12ad8 && $this->initializer12ad8->__invoke(
                $this->valueHolder0242b,
                $this,
                '__sleep',
                array(),
                $this->initializer12ad8
        );

        return array('valueHolder0242b');
    }

    public function __wakeup()
    {
        unset($this->dbo);
    }

    public function setProxyInitializer(Closure $initializer = null)
    {
        $this->initializer12ad8 = $initializer;
    }

    public function getProxyInitializer()
    {
        return $this->initializer12ad8;
    }

    public function initializeProxy(): bool
    {
        return $this->initializer12ad8 && $this->initializer12ad8->__invoke(
                        $this->valueHolder0242b,
                        $this,
                        'initializeProxy',
                        array(),
                        $this->initializer12ad8
                );
    }

    public function isProxyInitialized(): bool
    {
        return null !== $this->valueHolder0242b;
    }

    public function getWrappedValueHolderValue(): ?object
    {
        return $this->valueHolder0242b;
    }


}
