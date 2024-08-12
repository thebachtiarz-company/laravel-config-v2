<?php

namespace TheBachtiarz\Config\Repositories;

use Illuminate\Support\Str;
use TheBachtiarz\Base\Exceptions\BaseException;
use TheBachtiarz\Base\Repositories\AbstractRepository;
use TheBachtiarz\Config\Interfaces\Models\ConfigInterface;
use TheBachtiarz\Config\Interfaces\Repositories\ConfigRepositoryInterface;

class ConfigRepository extends AbstractRepository implements ConfigRepositoryInterface
{
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->setModelEntity(ConfigInterface::class);

        parent::__construct();
    }

    // ? Public Methods

    /**
     * Get config by path
     */
    public function getByPath(string $path): ?ConfigInterface
    {
        $this->modelBuilder(
            modelBuilder: $this->modelEntity::query()->where(
                column: ConfigInterface::ATTRIBUTE_PATH,
                operator: '=',
                value: Str::replace(search: ' ', replace: '_', subject: $path),
            ),
        );

        $entity = $this->modelBuilder()->first();

        if (!$entity && $this->throwIfNullEntity()) {
            throw new BaseException(
                message: sprintf(
                    $this->getByIdErrorMessage(),
                    $this->modelEntityName,
                    Str::replace(search: ' ', replace: '_', subject: $path),
                ),
                code: 404,
            );
        }

        return $entity;
    }

    // ? Protected Methods

    // ? Private Methods

    // ? Getter Modules

    // ? Setter Modules
}
