<?php

namespace Spatie\Diff;

use Spatie\Diff\Enums\DiffResultLineType;

class DiffResultLine
{
    public function __construct(
        public DiffResultLineType $type,
        public ?string $key,
        public mixed $value,
        public mixed $oldValue = null,
    ) {
    }
}
