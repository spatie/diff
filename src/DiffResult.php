<?php

namespace Spatie\Diff;

use Spatie\Diff\Enums\DiffResultLineType;
use Spatie\Diff\Renderers\Renderer;

class DiffResult
{
    /** @var array<\Spatie\Diff\DiffResultLine> */
    protected array $lines = [];

    public function __construct(
        protected mixed $first,
        protected mixed $second)
    {

    }

    public function add(
        DiffResultLineType $type,
        string $key,
        mixed $value,
        mixed $oldValue = null
    ): self {
        $this->lines[] = new DiffResultLine($type, $key, $value, $oldValue);

        return $this;
    }

    /** @return array<\Spatie\Diff\DiffResultLine> */
    public function getLines(): array
    {
        return $this->lines;
    }

    public function render(Renderer $renderer): string
    {
        return $renderer->render($this);
    }
}
