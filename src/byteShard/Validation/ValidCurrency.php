<?php
/**
 * @copyright  Copyright (c) 2009 Bespin Studios GmbH
 * @license    See LICENSE file that is distributed with this source code
 */

namespace byteShard\Validation;

use byteShard\Internal\Validation\InvariableValidation;

class ValidCurrency extends InvariableValidation
{
    public static function verify(mixed $value): bool
    {
        // this is the same pattern as the dhtmlx inbuilt validation
        $pattern = '/^\$?\s?\d+?([\.,\,]?\d+)?\s?\$?$/';
        return preg_match($pattern, $value) === 1;
    }

    public static function getFailureMessage(mixed $value, string $label): string
    {
        return '';
    }

    public function getClientValidation(): string
    {
        return 'ValidAplhaNumeric';
    }
}
