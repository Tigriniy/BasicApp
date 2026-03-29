<?php

namespace Validators;

use Src\Validator\AbstractValidator;

class EmailValidator extends AbstractValidator
{
    protected string $message = 'Неверный формат email';

    public function rule(): bool
    {
        return preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', trim($this->value));
    }
}