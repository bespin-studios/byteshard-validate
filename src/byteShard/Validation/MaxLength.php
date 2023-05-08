<?php
/**
 * @copyright  Copyright (c) 2009 Bespin Studios GmbH
 * @license    See LICENSE file that is distributed with this source code
 */

namespace byteShard\Validation;

use byteShard\Locale;
use byteShard\Internal\Validation\VariableValidation;

class MaxLength extends VariableValidation
{
    public function __construct(int $length)
    {
        parent::__construct($length);
        $this->setValidationUserData('bs_maxlength', $length);
    }

    public static function verify($value, $length): bool
    {
        if (function_exists('mb_strlen')) {
            return mb_strlen($value) <= $length;
        }
        return strlen($value) <= $length;
    }

    public static function getFailureMessage($value, $parameter, string $label): string
    {
        return sprintf(Locale::get('byteShard.validate.rule.max_length'), $parameter);
    }

    public function getClientValidation(): string
    {
        return 'maxLength';
    }
}
