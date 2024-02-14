<?php

declare(strict_types=1);

namespace MadeByDenis\PhpMjmlRenderer\Validation\Validators;

use MadeByDenis\PhpMjmlRenderer\Validation\Validatable;
use MadeByDenis\PhpMjmlRenderer\Validation\Validator;

abstract class BaseValidator implements Validatable
{
	/**
	 * @var \MadeByDenis\PhpMjmlRenderer\Validation\Validator
	 */
	protected Validator $validator;

	public function __construct(Validator $validator)
	{
		$this->validator = $validator;
	}

	abstract public function isValid(string $input): bool;
}
