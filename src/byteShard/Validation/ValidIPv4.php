<?php
/**
 * @copyright  Copyright (c) 2009 Bespin Studios GmbH
 * @license    See LICENSE file that is distributed with this source code
 */

namespace byteShard\Validation;

use byteShard\Internal\Validation\InvariableValidation;

class ValidIPv4 extends InvariableValidation
{
    public static function verify(mixed $value): bool
    {
        // this is the same pattern as the dhtmlx inbuilt validation
        $pattern = '/^(\d{1,3})\.(\d{1,3})\.(\d{1,3})\.(\d{1,3})$/';
        $matches = [];
        $match = preg_match($pattern, $value, $matches);
        return $match === 1 && $matches[1] >= 0 && $matches[1] <= 255 && $matches[2] >= 0 && $matches[2] <= 255 && $matches[3] >= 0 && $matches[3] <= 255 && $matches[4] >= 0 && $matches[4] <= 255;
    }

    public static function getFailureMessage(mixed $value, string $label): string
    {
        return '';
    }

    public function getClientValidation(): string
    {
        return 'ValidIPv4';
    }
}
