<?php

namespace Spatie\Diff\TypeDiffers;

use Spatie\Diff\DiffResult;

interface TypeDiffer
{
    public function canDiff(mixed $first, mixed $second): bool;

    public function diff(mixed $first, mixed $second): DiffResult;
}
