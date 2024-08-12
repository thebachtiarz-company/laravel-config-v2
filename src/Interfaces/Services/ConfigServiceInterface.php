<?php

namespace TheBachtiarz\Config\Interfaces\Services;

use TheBachtiarz\Base\DTOs\Services\ResponseDataDTO;
use TheBachtiarz\Base\Interfaces\Services\ServiceInterface;
use TheBachtiarz\Config\Enums\Services\ConfigIsEncryptEnum;

interface ConfigServiceInterface extends ServiceInterface
{
    /**
     * Get config
     */
    public function getConfig(string $pathName): ResponseDataDTO;

    /**
     * Create or update config
     */
    public function createOrUpdate(string $pathName, mixed $value, ?ConfigIsEncryptEnum $isEncrypt = null): ResponseDataDTO;

    // ? Getter Modules

    // ? Setter Modules
}
