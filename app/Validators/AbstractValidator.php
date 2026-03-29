<?php

namespace Validators;

abstract class AbstractValidator
{
    protected $field;
    protected $value;
    protected $args;
    protected $message;

    public function __construct(string $field, $value, array $args = [], string $message = null)
    {
        $this->field = $field;
        $this->value = $value;
        $this->args = $args;
        $this->message = $message ?? $this->message;
    }

    abstract public function rule(): bool;

    public function validate()
    {
        if (!$this->rule()) {
            return $this->message;
        }
        return true;
    }
}