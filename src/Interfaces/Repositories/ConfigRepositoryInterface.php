<?php

namespace TheBachtiarz\Config\Interfaces\Repositories;

use TheBachtiarz\Base\Interfaces\Repositories\RepositoryInterface;
use TheBachtiarz\Config\Interfaces\Models\ConfigInterface;

interface ConfigRepositoryInterface extends RepositoryInterface
{
    /**
     * Get config by path
     */
    public function getByPath(string $path): ?ConfigInterface;

    // public function create

    // ? Getter Modules

    // ? Setter Modules
}
