<?php
/**
 * @copyright  Copyright (c) 2009 Bespin Studios GmbH
 * @license    See LICENSE file that is distributed with this source code
 */

namespace byteShard\Internal\Validation;

abstract class VariableValidation extends Validation
{
    private mixed $parameter;
    
    public function __construct(mixed $parameter) {
        $this->parameter = $parameter;
    }
    
    public function getParameter(): mixed
    {
        return $this->parameter;
    }
    
    // static callback to verify client input. This will be executed on the server side
    abstract public static function verify($value, $parameter): bool;

    // static callback to get a meaningful client message on failed validations
    abstract public static function getFailureMessage($value, $parameter, string $label): string;
}
