<?php

namespace TheBachtiarz\Config\Http\Requests\Rules;

use TheBachtiarz\Base\Http\Requests\Rules\AbstractRule;

class ConfigPathRule extends AbstractRule
{
    public const PATH = 'path';

    #[\Override]
    public static function rules(): array
    {
        return [
            self::PATH => [
                'required',
                'regex:/^[a-zA-Z0-9._-]+$/',
            ],
        ];
    }
}
