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
                $ruleParams = [];

                // Check if the rule has parameters (e.g. min:3) and extract them to separate array
                if (str_contains($rule, ":")) {
                    [$rule_name, $ruleParams] = explode(":", $rule);
                    $ruleParams = explode(",", $ruleParams);
                } else {
                    $rule_name = $rule;
                }


                // Check if the rule exists in the rules array
                if (array_key_exists($rule_name, $this->rules)) {

                    // Get the rule instance and validate the field
                    $ruleInstance = $this->rules[$rule_name];

                    if (!$ruleInstance->validate($data, $field, $ruleParams)) {
                        $errors[$field][] = $ruleInstance->getErrorMessage($data, $field, $ruleParams);
                    }
                }
            }
        }

        if (!empty($errors))
            throw new ValidationException(422, json_encode($errors));

        return $errors;
    }
}