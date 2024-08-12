<?php

namespace TheBachtiarz\Config\Http\Requests;

use TheBachtiarz\Base\Http\Requests\AbstractRequest;
use TheBachtiarz\Config\Http\Requests\Rules\ConfigPathRule;

class ConfigGetRequest extends AbstractRequest
{
    #[\Override]
    protected function buildValidator(): void
    {
        $this->validatorBuilder
            ->addRules(new ConfigPathRule());

        parent::buildValidator();
    }
}
