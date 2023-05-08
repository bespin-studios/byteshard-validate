<?php
/**
 * @copyright  Copyright (c) 2009 Bespin Studios GmbH
 * @license    See LICENSE file that is distributed with this source code
 */

namespace byteShard\Validation;

use byteShard\Internal\Validation\InvariableValidation;

class ValidBoolean extends InvariableValidation
{
    public static function verify(mixed $value): bool
    {
        return in_array($value, [0, 1, true, false, 'true', 'false', '0', '1'], true);
    }

    public static function getFailureMessage(mixed $value, string $label): string
    {
        return '';
    }

    public function getClientValidation(): string
    {
        return 'ValidBoolean';
    }
}
