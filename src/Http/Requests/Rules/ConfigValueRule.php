<?php

namespace TheBachtiarz\Config\Http\Requests\Rules;

use TheBachtiarz\Base\Http\Requests\Rules\AbstractRule;

class ConfigValueRule extends AbstractRule
{
    public const VALUE = 'value';

    #[\Override]
    public static function rules(): array
    {
        return [
            self::VALUE => [
                'required',
                'string',
            ],
        ];
    }
}
