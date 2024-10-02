<?php

namespace TheBachtiarz\Config\Helpers;

class DataValueHelper
{
    /**
     * Get value type
     *
     * @param mixed $value
     * @return string
     */
    public static function getType(mixed $value): string
    {
        return gettype($value);
    }

    /**
     * Modify value to different type
     *
     * @param mixed $value
     * @param array<string,Closure>|null $modifyByType
     * @return mixed
     */
    public static function modifyValueToDiffType(mixed $value, ?array $modifyByType = null): mixed
    {
        return match (static::getType($value)) {
            'array' => @$modifyByType['array'] ? $modifyByType['array']($value) : $value,
            'string' => @$modifyByType['string'] ? $modifyByType['string']($value) : $value,
            default => $value,
        };
    }
}
