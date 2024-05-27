<?php

declare(strict_types=1);

namespace Framework\Rules;

use Framework\Contracts\RuleInterface;

class MaxLengthRule implements RuleInterface
{
    public function validate(array $data, string $field, array $params): bool
    {
        return strlen($data[$field]) <= $params[0];
    }

    public function getErrorMessage(array $data, string $field, array $params): string
    {
        return "The $field field must be at most {$params[0]} characters long!";
    }
}