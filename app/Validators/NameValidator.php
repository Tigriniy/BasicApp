<?php

namespace Validators;

use Src\Validator\AbstractValidator;

class NameValidator extends AbstractValidator
{
    protected string $message = 'Поле должно содержать только буквы (кириллица)';

    public function rule(): bool
    {
        return preg_match('/^[a-zа-яё]+$/ui', $this->value);
    }
}