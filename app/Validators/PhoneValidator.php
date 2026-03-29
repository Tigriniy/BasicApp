<?php

namespace Validators;

use Src\Validator\AbstractValidator;

class PhoneValidator extends AbstractValidator
{
    protected string $message = 'Номер телефона должен быть в формате +7 (999) 123-45-67';

    public function rule(): bool
    {
        return preg_match('/^\+7 \(\d{3}\) \d{3}-\d{2}-\d{2}$/', $this->value);
    }
}