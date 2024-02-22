<?php

namespace Spatie\Diff;

use Spatie\Diff\Exceptions\CannotDiff;
use Spatie\Diff\TypeDiffers\ArrayDiffer;
use Spatie\Diff\TypeDiffers\ObjectDiffer;
use Spatie\Diff\TypeDiffers\ScalarDiffer;
use Spatie\Diff\TypeDiffers\TypeDiffer;

class Differ
{
    /** @var array<\Spatie\Diff\TypeDiffers\TypeDiffer> */
    protected array $differs = [
        ScalarDiffer::class,
        ObjectDiffer::class,
        Arraydiffer::class,
    ];

    public function diff(mixed $first, mixed $second): DiffResult
    {
        $this->ensureSameTypes($first, $second);

        $typeDiffer = $this->determineTypeDiffer($first, $second);

        if (! $typeDiffer) {
            throw CannotDiff::noDifferFound($first, $second);
        }

        return $typeDiffer->diff($first, $second);
    }

    protected function determineTypeDiffer(mixed $first, mixed $second): ?TypeDiffer
    {
        foreach($this->differs as $differClass) {
            $differClass = new $differClass;

            if ($differClass->candiff($first, $second)) {
                return $differClass;
            }
        }

        return null;
    }

    protected function ensureSameTypes(mixed $first, mixed $second): void
    {
        if (is_scalar($first) && is_scalar($second)) {
            return;
        }

        if (is_array($first) && is_array($second)) {
            return;
        }

        if (is_object($first) && is_object($second)) {
            return;
        }

        throw CannotDiff::differentTypes($first, $second);
    }
}
