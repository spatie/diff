<?php

namespace Spatie\Diff\TypeDiffers;

use Spatie\Diff\DiffResult;
use Spatie\Diff\Enums\DiffResultLineType;

class ArrayDiffer implements TypeDiffer
{
    public function canDiff(mixed $first, mixed $second): bool
    {
        return is_array($first) && is_array($second);
    }

    /**
     * @param  array  $first
     * @param  array  $second
     */
    public function diff($first, $second): DiffResult
    {
        return $this->isIndexed($first) || $this->isIndexed($second)
            ? $this->diffIndexedArray($first, $second)
            : $this->diffAssociativeArray($first, $second);
    }

    public function diffIndexedArray(array $first, array $second): DiffResult
    {
        $diffResult = new DiffResult($first, $second);

        foreach (array_diff($second, $first) as $value) {
            $diffResult->add(DiffResultLineType::Added, null, $value);
        }

        foreach (array_diff($first, $second) as $value) {
            $diffResult->add(DiffResultLineType::Removed, null, $value);
        }

        return $diffResult;
    }

    public function diffAssociativeArray(array $first, array $second): DiffResult
    {
        $diffResult = new DiffResult($first, $second);

        foreach (array_diff_key($second, $first) as $key => $value) {
            $diffResult->add(DiffResultLineType::Added, $key, $value);
        }

        foreach (array_diff_key($first, $second) as $key => $value) {
            $diffResult->add(DiffResultLineType::Removed, $key, $value);
        }

        foreach ($first as $key => $value) {
            if (array_key_exists($key, $second)) {
                if ($second[$key] !== $value) {
                    $diffResult->add(DiffResultLineType::Changed, $key, $second[$key], $value);
                }
            }
        }

        return $diffResult;

    }

    protected function isIndexed(array $array): bool
    {
        return array_values($array) === $array;
    }
}
