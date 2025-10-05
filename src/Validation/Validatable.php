<?php

declare(strict_types=1);

namespace MadeByDenis\PhpMjmlRenderer\Validation;

interface Validatable
{
	public function isValid(string $input): bool;
}
