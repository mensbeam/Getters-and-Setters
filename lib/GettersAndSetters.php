<?php
/**
 * @license MIT
 * Copyright 2023 Dustin Wilson, J. King et al.
 * See LICENSE and AUTHORS files for details
 */

declare(strict_types=1);
namespace MensBeam\Foundation;


trait GettersAndSetters {
    public function __get(string $name): mixed {
        $methodName = $this->__getGetterSetterMethodName($name);
        if ($methodName === null) {
            trigger_error(sprintf('Undefined property: %s::%s', get_called_class(), $name), \E_USER_WARNING);
            return null;
        }
        return $this->$methodName();
    }

    public function __isset(string $name): bool {
        return ($this->__getGetterSetterMethodName($name) !== null);
    }

    public function __set(string $name, $value): void {
        $methodName = $this->__getGetterSetterMethodName($name, false);
        if ($methodName !== null) {
            $this->$methodName($value);
            return;
        }

        $calledClass = get_called_class();
        if ($this->__getGetterSetterMethodName($name) !== null) {
            throw new \Error(sprintf('Cannot modify readonly property %s::%s', $calledClass, $name));
        }

        trigger_error(sprintf('Undefined property: %s::%s', $calledClass, $name), \E_USER_WARNING);
    }

    public function __unset(string $name): void {
        $methodName = $this->__getGetterSetterMethodName($name, false);
        if ($methodName === null) {
            throw new \Error(sprintf('Cannot modify readonly property %s::%s', get_called_class(), $name));
        }

        call_user_func([ $this, $methodName ], null);
    }


    private function __getGetterSetterMethodName(string $name, bool $get = true): ?string {
        $methodName = "__" . (($get) ? 'get' : 'set') . "_{$name}";
        return (method_exists($this, $methodName)) ? $methodName : null;
    }
}