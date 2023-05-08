<?php
/**
 * @copyright  Copyright (c) 2009 Bespin Studios GmbH
 * @license    See LICENSE file that is distributed with this source code
 */

namespace byteShard\Internal\Validation;


class ValidationResult
{
    private array $failedValidations = [];

    public function addFailedValidation(string $clientMessage): void
    {
        $this->failedValidations[] = $clientMessage;
    }

    public function getClientMessage(): string
    {
        return '';
    }

    public function isValid(): bool
    {
        return empty($this->failedValidations);
    }

    public function getFailedValidation(): array
    {
        return $this->failedValidations;
    }
}