<?php

namespace Spatie\Diff\TypeDiffers;

use Spatie\Diff\DiffResult;

class ObjectDiffer implements TypeDiffer
{
    public function canDiff(mixed $first, mixed $second): bool
    {
        return is_object($first) && is_object($second);
    }

    public function diff($first, $second): DiffResult
    {
        // TODO: Implement diff() method.
    }
}
