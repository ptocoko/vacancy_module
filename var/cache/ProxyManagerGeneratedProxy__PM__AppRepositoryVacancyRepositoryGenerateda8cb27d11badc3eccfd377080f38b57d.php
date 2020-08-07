<?php

namespace ProxyManagerGeneratedProxy\__PM__\App\Repository\VacancyRepository;

use App\Core\Dbo;
use App\Repository\VacancyRepository;
use Closure;
use ProxyManager\Proxy\VirtualProxyInterface;
use ProxyManager\Stub\EmptyClassStub;
use ReflectionClass;

use const E_USER_NOTICE;

class Generateda8cb27d11badc3eccfd377080f38b57d extends VacancyRepository implements VirtualProxyInterface
{

    /**
     * @var bool[] map of public properties of the parent class
     */
    private static $publicPropertiesd47f5 = [

    ];
    private static $signaturea8cb27d11badc3eccfd377080f38b57d = 'YTo0OntzOjk6ImNsYXNzTmFtZSI7czozMjoiQXBwXFJlcG9zaXRvcnlcVmFjYW5jeVJlcG9zaXRvcnkiO3M6NzoiZmFjdG9yeSI7czo1MDoiUHJveHlNYW5hZ2VyXEZhY3RvcnlcTGF6eUxvYWRpbmdWYWx1ZUhvbGRlckZhY3RvcnkiO3M6MTk6InByb3h5TWFuYWdlclZlcnNpb24iO3M6NDY6IjIuMi4zQDRkMTU0NzQyZTMxYzM1MTM3ZDUzNzRjOTk4ZThmODZiNTRkYjJlMmYiO3M6MTI6InByb3h5T3B0aW9ucyI7YTowOnt9fQ==';
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
            $reflection = $reflection ?: new ReflectionClass('App\\Repository\\VacancyRepository');
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

    public function findBy(
            int $areaCode,
            string $schoolId,
            int $positionId,
            ?array $payment,
            int $experienceId,
            int $offset = 0
    ): array {
        $this->initializer12ad8 && $this->initializer12ad8->__invoke(
                $this->valueHolder0242b,
                $this,
                'findBy',
                array(
                        'areaCode' => $areaCode,
                        'schoolId' => $schoolId,
                        'positionId' => $positionId,
                        'payment' => $payment,
                        'experienceId' => $experienceId,
                        'offset' => $offset
                ),
                $this->initializer12ad8
        );

        return $this->valueHolder0242b->findBy($areaCode, $schoolId, $positionId, $payment, $experienceId, $offset);
    }

    public function findBySchoolId(string $schoolId): array
    {
        $this->initializer12ad8 && $this->initializer12ad8->__invoke(
                $this->valueHolder0242b,
                $this,
                'findBySchoolId',
                array('schoolId' => $schoolId),
                $this->initializer12ad8
        );

        return $this->valueHolder0242b->findBySchoolId($schoolId);
    }

    public function countOfVacanciesWith(int $positionId, string $schoolId): int
    {
        $this->initializer12ad8 && $this->initializer12ad8->__invoke(
                $this->valueHolder0242b,
                $this,
                'countOfVacanciesWith',
                array(
                        'positionId' => $positionId,
                        'schoolId' => $schoolId
                ),
                $this->initializer12ad8
        );

        return $this->valueHolder0242b->countOfVacanciesWith($positionId, $schoolId);
    }

    public function saveVacancy(
            int $positionId,
            int $paymentValue,
            int $experienceId,
            string $dopInfo,
            int $directorId,
            string $schoolId,
            int $areaCode,
            string $dateInsert
    ): array {
        $this->initializer12ad8 && $this->initializer12ad8->__invoke(
                $this->valueHolder0242b,
                $this,
                'saveVacancy',
                array(
                        'positionId' => $positionId,
                        'paymentValue' => $paymentValue,
                        'experienceId' => $experienceId,
                        'dopInfo' => $dopInfo,
                        'directorId' => $directorId,
                        'schoolId' => $schoolId,
                        'areaCode' => $areaCode,
                        'dateInsert' => $dateInsert
                ),
                $this->initializer12ad8
        );

        return $this->valueHolder0242b->saveVacancy(
                $positionId,
                $paymentValue,
                $experienceId,
                $dopInfo,
                $directorId,
                $schoolId,
                $areaCode,
                $dateInsert
        );
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

    public function updateVacancy(
            int $id,
            ?string $positionId,
            ?int $paymentValue,
            int $experienceId,
            string $dopInfo
    ): array {
        $this->initializer12ad8 && $this->initializer12ad8->__invoke(
                $this->valueHolder0242b,
                $this,
                'updateVacancy',
                array(
                        'id' => $id,
                        'positionId' => $positionId,
                        'paymentValue' => $paymentValue,
                        'experienceId' => $experienceId,
                        'dopInfo' => $dopInfo
                ),
                $this->initializer12ad8
        );

        return $this->valueHolder0242b->updateVacancy($id, $positionId, $paymentValue, $experienceId, $dopInfo);
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
