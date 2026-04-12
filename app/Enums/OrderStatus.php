<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;
use Illuminate\Contracts\Support\Htmlable;

enum OrderStatus: string implements HasLabel, HasColor
{
    case QUEUE = 'queue';
    case PROCESSING = 'processing';
    case ENDED = 'ended';
    case SOSPENDED = 'sospended';
    case CANCELLED = 'cancelled';
    case PAUSED = 'paused';
    case WARNING = 'warning';
    case PARTIALED = 'partial-end';

    public function label(): string | Htmlable | null
    {
        return match ($this) {
            self::QUEUE => 'In coda',
            self::PROCESSING => 'In Produzione',
            self::ENDED => 'Completato',
            self::SOSPENDED => 'Sospeso',
            self::CANCELLED => 'Cancellato',
            self::PAUSED => 'In Pausa',
            self::WARNING => 'Attenzione!',
            self::PARTIALED => 'Parziale',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::QUEUE => 'primary',
            self::PROCESSING => 'success',
            self::ENDED => 'grey',
            self::SOSPENDED => 'teal',
            self::CANCELLED => 'danger',
            self::PAUSED => 'warning',
            self::WARNING => 'warning',
            self::PARTIALED => 'info',
        };
    }

    public function getLabel(): string
    {
        return $this->label();
    }

    public function getColor(): string
    {
        return $this->color();
    }

    public static function labels(): array
    {
        return array_map(fn($category) => $category->label(), self::cases());
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public static function array(): array
    {
        return array_combine(self::values(), self::labels());
    }

    public function isFinalized(): bool
    {
        return in_array($this, [self::ENDED, self::CANCELLED]);
    }
}
