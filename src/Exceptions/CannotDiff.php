<?php

namespace Spatie\Diff\Exceptions;

use Exception;

class CannotDiff extends Exception
{
    public static function noDifferFound(mixed $first, mixed $second): self
    {
        return new self("We could not find a differ for the given type of the passed arguments");
    }

    public static function differentTypes(mixed $first, mixed $second): self
    {
        return new self("The given arguments are of different types");
    }
}
