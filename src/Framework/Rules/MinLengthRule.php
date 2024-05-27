<?php

declare(strict_types=1);

namespace Framework\Rules;

use Framework\Contracts\RuleInterface;
use InvalidArgumentException;

class MinLengthRule implements RuleInterface
{
    public function validate(array $data, string $field, array $params): bool
    {
        if (count($params) !== 1) {
            throw new InvalidArgumentException('Min rule requires one parameter');
        }

        return strlen($data[$field]) >= (int) $params[0];
    }

    public function getErrorMessage(array $data, string $field, array $params): string
    {
        return "The $field field must be at least {$params[0]} characters long!";
    }
}