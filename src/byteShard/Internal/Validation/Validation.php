<?php
/**
 * @copyright  Copyright (c) 2009 Bespin Studios GmbH
 * @license    See LICENSE file that is distributed with this source code
 */

namespace byteShard\Internal\Validation;

abstract class Validation
{
    private mixed $arg                = null;
    private array $validationUserData = [];

    protected function setArgument(mixed $arg = null): void
    {
        $this->arg = $arg;
    }

    // client validation. Either inbuilt dhtmlx validations or custom validations
    abstract public function getClientValidation(): string;

    // name of the validation class. During client validation each client value will call classname::verify where classname is the return value (with namespace) of this function
    final public function className(): string
    {
        return static::class;
    }

    // the contents of this array will be packed and encrypted into data that is sent to the client
    final public function getClientArray(): array
    {
        $name = get_class($this);
        // replace byteShard\Validation with a single character # to reduce client payload.
        // keep the namespace for custom validations
        if (str_starts_with($name, 'byteShard\\Validation\\')) {
            $name = str_replace('byteShard\\Validation\\', '!', $name);
        }
        // the array index a and c are realized this way to have a minimum json string length
        // a: json will create an array of the result
        // c: json will create an object of the result
        if ($this instanceof InvariableValidation) {
            return ['a' => [$name]];
        } elseif ($this instanceof VariableValidation) {
            return ['o' => [$name => $this->getParameter()]];
        }
        return [];
    }

    protected function setValidationUserData(string $key, mixed $value): void
    {
        $this->validationUserData[$key] = $value;
    }

    public function getUserData(): array
    {
        return $this->validationUserData;
    }

    final public static function validate(object $validations, mixed $clientValue, string $label): ValidationResult
    {
        $result = new ValidationResult();
        if (property_exists($validations, 'a')) {
            foreach ($validations->a as $validationClassName) {
                $validationClassName = self::getValidationClass($validationClassName);
                if (is_subclass_of($validationClassName, InvariableValidation::class)) {
                    if ($validationClassName::verify($clientValue) === false) {
                        $result->addFailedValidation($validationClassName::getFailureMessage($clientValue, $label));
                    }
                }
            }
        }
        if (property_exists($validations, 'o')) {
            foreach ($validations->o as $validationClassName => $parameter) {
                $validationClassName = self::getValidationClass($validationClassName);
                if (is_subclass_of($validationClassName, VariableValidation::class)) {
                    if ($validationClassName::verify($clientValue, $parameter) === false) {
                        $result->addFailedValidation($validationClassName::getFailureMessage($clientValue, $parameter, $label));
                    }
                }
            }
        }
        return $result;
    }

    private static function getValidationClass(string $className): string
    {
        if (str_starts_with($className, '!')) {
            return '\\byteShard\\Validation\\'.ltrim($className, '!');
        }
        return '\\'.$className;
    }
}
