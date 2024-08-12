<?php

namespace TheBachtiarz\Config\Enums\Services;

use TheBachtiarz\Base\Traits\Enums\AbstractEnum;

enum ConfigIsEncryptEnum: int
{
    use AbstractEnum;

    case TRUE = 1;
    case FALSE = 2;

    /**
     * Get as boolean
     */
    public function toBoolean(): bool
    {
        return match ($this) {
            self::TRUE => true,
            self::FALSE => false,
            default => false,
        };
    }

    /**
     * Get label
     */
    public function getLabel(): string
    {
        return match ($this) {
            self::TRUE => 'True',
            default => 'False',
        };
    }
}
