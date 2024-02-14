<?php

declare(strict_types=1);

namespace MadeByDenis\PhpMjmlRenderer\Validation\Validators;

use MadeByDenis\PhpMjmlRenderer\Validation\Validatable;
use MadeByDenis\PhpMjmlRenderer\Validation\Validator;

class AlignmentValidator extends BaseValidator
{
	public function isValid(string $value): bool
	{
		return $this->validator->isAlignment($value);
	}
}
