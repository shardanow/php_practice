<?php

declare(strict_types=1);

namespace App\Services;

use Framework\Validator;
use Framework\Rules\{
    RequiredRule,
    EmailRule,
    MinLengthRule,
    MaxLengthRule,
    MatchRule
};

class ValidatorService
{
    private Validator $validator;

    public function __construct()
    {
        $this->validator = new Validator();

        $this->validator->addRule("required", new RequiredRule());
        $this->validator->addRule("email", new EmailRule());
        $this->validator->addRule("minLength", new MinLengthRule());
        $this->validator->addRule("maxLenght", new MaxLengthRule());
        $this->validator->addRule("match", new MatchRule());
    }

    public function validate(array $data, array $rules): array
    {
        return $this->validator->validate($data, $rules);
    }

}