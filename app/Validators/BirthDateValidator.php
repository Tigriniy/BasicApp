<?php

namespace Validators;

use Src\Validator\AbstractValidator;

class BirthDateValidator extends AbstractValidator
{
    protected string $message = 'Неверный формат даты рождения. Используйте YYYY-MM-DD';

    public function rule(): bool
    {
        return preg_match('/^\d{4}-\d{2}-\d{2}$/', trim($this->value));
    }
}