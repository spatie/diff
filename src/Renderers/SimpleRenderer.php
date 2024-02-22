<?php

namespace Spatie\Diff\Renderers;

use Spatie\Diff\DiffResult;
use Spatie\Diff\DiffResultLine;
use Spatie\Diff\Enums\DiffResultLineType;

class SimpleRenderer implements Renderer
{
    public function render(DiffResult $diffResult): string
    {
        $stringLines = array_map(function (DiffResultLine $line) {
            $key = ' ' . $line->key ?? '';

            $string = "{$this->getSymbol($line->type)}{$key} => {$this->toString($line->value)}";

            if ($line->oldValue !== null) {
                $string .= " (from {$this->toString($line->oldValue)})";
            }

            return $string;
        }, $diffResult->getLines());

        return implode(PHP_EOL, $stringLines);
    }

    protected function getSymbol(DiffResultLineType $lineType): string
    {
        return match ($lineType) {
            DiffResultLineType::Added => '+',
            DiffResultLineType::Removed => '-',
            DiffResultLineType::Changed => 'U',
        };
    }

    protected function toString(mixed $anything): string
    {
        return match (true) {
            is_string($anything) => $anything,
            is_array($anything) => json_encode($anything),
            is_object($anything) => json_encode($anything),
            default => (string) $anything,
        };
    }
}
