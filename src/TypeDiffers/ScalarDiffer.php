<?php

namespace Spatie\Diff\TypeDiffers;

use Spatie\Diff\DiffResult;

class ScalarDiffer implements TypeDiffer
{

    public function canDiff(mixed $first, mixed $second): bool
    {
        return is_scalar($first) && is_scalar($second);
    }

    public function diff($first, $second): DiffResult
    {
        // TODO: Implement diff() method.
    }
}
