<?php

namespace TheBachtiarz\Config\Http\Requests\Rules;

use Illuminate\Validation\Rule;
use TheBachtiarz\Base\Http\Requests\Rules\AbstractRule;
use TheBachtiarz\Config\Enums\Services\ConfigIsEncryptEnum;

class ConfigIsEncryptRule extends AbstractRule
{
    public const ENCRYPT = 'encrypt';

    #[\Override]
    public static function rules(): array
    {
        return [
            self::ENCRYPT => [
                'required',
                'integer',
                Rule::enum(ConfigIsEncryptEnum::class),
            ],
        ];
    }

    #[\Override]
    public static function messages(): array
    {
        return [
            sprintf('%s.*', self::ENCRYPT) => sprintf('Config encrypt only accept [%s]', implode(separator: ', ', array: ConfigIsEncryptEnum::messages())),
        ];
    }
}
