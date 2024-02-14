<?php

declare(strict_types=1);

namespace MadeByDenis\PhpMjmlRenderer\Validation\Validators;

use MadeByDenis\PhpMjmlRenderer\Validation\Validatable;
use MadeByDenis\PhpMjmlRenderer\Validation\Validator;

class TextDirectionValidator extends BaseValidator
{
	public function isValid(string $direction): bool
	{
		return $this->validator->isTextDirection($direction);
	}
}
