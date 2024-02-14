<?php

declare(strict_types=1);

namespace MadeByDenis\PhpMjmlRenderer\Validation\Validators;

use MadeByDenis\PhpMjmlRenderer\Validation\Validatable;
use MadeByDenis\PhpMjmlRenderer\Validation\Validator;

class TextTransformValidator extends BaseValidator
{
	public function isValid(string $transform): bool
	{
		return $this->validator->isTextTransform($transform);
	}
}
