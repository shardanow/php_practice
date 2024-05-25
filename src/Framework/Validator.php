<?php

declare(strict_types=1);

namespace Framework;

use Framework\Contracts\RuleInterface;
use Framework\Exceptions\ValidationException;

class Validator
{
    private array $rules = [];

    public function addRule(string $rule, RuleInterface $ruleInstance): void
    {
        $this->rules[$rule] = $ruleInstance;
    }



    public function validate(array $data, array $rules): array
    {
        $errors = [];

        foreach ($rules as $field => $fieldRules) {
            foreach ($fieldRules as $rule) {
                if (array_key_exists($rule, $this->rules)) {
                    $ruleInstance = $this->rules[$rule];

                    if (!$ruleInstance->validate($data, $field, [])) {
                        $errors[$field][] = $ruleInstance->getErrorMessage($data, $field, []);
                    }
                }
            }
        }

        if (!empty($errors))
            throw new ValidationException(422, json_encode($errors));

        return $errors;
    }

    // public function validate(array $data, array $rules): array
    // {
    //     $errors = [];

    //     foreach ($rules as $field => $fieldRules) {
    //         foreach ($fieldRules as $rule) {
    //             if ($rule === "required" && empty($data[$field])) {
    //                 $errors[$field][] = "The $field field is required";
    //             }

    //             if ($rule === "email" && !filter_var($data[$field], FILTER_VALIDATE_EMAIL)) {
    //                 $errors[$field][] = "The $field field must be a valid email address";
    //             }

    //             if ($rule === "min" && strlen($data[$field]) < 6) {
    //                 $errors[$field][] = "The $field field must be at least 6 characters";
    //             }
    //         }
    //     }

    //     return $errors;
    // }
}