<?php

declare(strict_types=1);

namespace MadeByDenis\PhpMjmlRenderer\Validation\Validators;

use MadeByDenis\PhpMjmlRenderer\Validation\Validatable;
use MadeByDenis\PhpMjmlRenderer\Validation\Validator;

class IntegerValidator extends BaseValidator
{
	public function isValid(string $number): bool
	{
		return $this->validator->isInteger($number);
	}
}
