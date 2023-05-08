<?php
/**
 * @copyright  Copyright (c) 2009 Bespin Studios GmbH
 * @license    See LICENSE file that is distributed with this source code
 */

namespace byteShard\Internal\Validation;

abstract class InvariableValidation extends Validation
{
    final public function __construct(){}

    // static callback to verify client input. This will be executed on the server side
    abstract public static function verify(mixed $value): bool;

    // static callback to get a meaningful client message on failed validations
    abstract public static function getFailureMessage(mixed $value, string $label): string;
}
