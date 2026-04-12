<?php

namespace App\Enums;

enum OrderStatus: string
{
    case QUEUE = 'queue';
    case PROCESSING = 'processing';
    case ENDED = 'ended';
    case SOSPENDED = 'sospended';
    case CANCELLED = 'cancelled';
    case PAUSED = 'paused';
    case WARNING = 'warning';
    case PARTIALED = 'partialed';

    public function label(): string
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

    // public function getLabel(): string
    // {
    //     return match ($this) {
    //         self::NUM => 'Numerico',
    //         self::STRING => 'Alfanumerico',
    //         self::BOOL => 'Logico',
    //         self::DATE => 'Data',
    //         self::NOTE => 'Note',
    //     };
    // }

    // public function getColor(): string
    // {
    //     return match ($this) {
    //         self::NUM => 'info',
    //         self::STRING => 'success',
    //         self::BOOL => 'primary',
    //         self::DATE => 'warning',
    //         self::NOTE => 'danger',
    //     };
    // }

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
