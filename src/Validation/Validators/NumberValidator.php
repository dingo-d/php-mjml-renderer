<?php

declare(strict_types=1);

namespace MadeByDenis\PhpMjmlRenderer\Validation\Validators;

use MadeByDenis\PhpMjmlRenderer\Validation\Validatable;
use MadeByDenis\PhpMjmlRenderer\Validation\Validator;

class NumberValidator extends BaseValidator
{
	public function isValid(string $number): bool
	{
		return $this->validator->isNumber($number);
	}
}
