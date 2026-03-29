<?php

namespace Validators;

use Src\Validator\AbstractValidator;

class PhoneValidator extends AbstractValidator
{
    protected $message = 'Неверный формат телефона. Пример: +7 (999) 123-45-67';

    public function rule(): bool
    {
        // Поддерживает +7 и 8, скобки, пробелы, дефисы
        return preg_match('/^(\+7|8)[\s\-]?\(?\d{3}\)?[\s\-]?\d{3}[\s\-]?\d{2}[\s\-]?\d{2}$/', trim($this->value));
    }
}