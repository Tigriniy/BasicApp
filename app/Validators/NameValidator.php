<?php

namespace Validators;

use Src\Validator\AbstractValidator;

class NameValidator extends AbstractValidator
{
    protected $message = 'Поле :field должно содержать только русские буквы, пробелы и дефис';

    public function rule(): bool
    {
        return preg_match('/^[а-яёА-ЯЁ\s\-]+$/u', trim($this->value));
    }
}