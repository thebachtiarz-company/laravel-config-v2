<?php

namespace TheBachtiarz\Config\Http\Requests;

use TheBachtiarz\Base\Http\Requests\AbstractRequest;
use TheBachtiarz\Config\Http\Requests\Rules\ConfigIsEncryptRule;
use TheBachtiarz\Config\Http\Requests\Rules\ConfigPathRule;
use TheBachtiarz\Config\Http\Requests\Rules\ConfigValueRule;

class ConfigCreateRequest extends AbstractRequest
{
    #[\Override]
    protected function buildValidator(): void
    {
        $this->validatorBuilder
            ->addRules(new ConfigPathRule())
            ->addRules(new ConfigIsEncryptRule())
            ->addRules(new ConfigValueRule());

        parent::buildValidator();
    }
}
