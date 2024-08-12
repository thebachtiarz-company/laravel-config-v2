<?php

namespace TheBachtiarz\Config\Helpers;

use TheBachtiarz\Base\Exceptions\BaseException;
use TheBachtiarz\Config\Enums\Services\ConfigIsEncryptEnum;
use TheBachtiarz\Config\Interfaces\Models\ConfigInterface;
use TheBachtiarz\Config\Interfaces\Repositories\ConfigRepositoryInterface;
use TheBachtiarz\Config\Models\Config;

class ConfigHelper
{
    /**
     * Get or Create or Update Config
     *
     * @param string $path
     * @param mixed $value To create/update current config value.
     * @param integer|null $isEncrypt To define is value encrypted.
     */
    public static function config(string $path, mixed $value = null, ?int $isEncrypt = null): mixed
    {
        $entity = static::init()->throwIfNullEntity(false)->getByPath(path: $path);

        if (!$entity) {
            if (!$value) {
                throw new BaseException(message: sprintf("Config with path '%s' not found", $path), code: 404);
            }

            CREATE:
            $entity = static::init()->createOrUpdate(
                (new Config())
                    ->setPath($path)
                    ->setIsEncrypt(ConfigIsEncryptEnum::tryFrom($isEncrypt ?? ConfigIsEncryptEnum::FALSE->value)->toBoolean())
                    ->setValue($value),
            );

            goto RESULT;
        }

        UPDATE:
        if ($value) {
            $entity->setIsEncrypt(ConfigIsEncryptEnum::tryFrom($isEncrypt ?? ConfigIsEncryptEnum::FALSE->value)->toBoolean());
            $entity->setValue($value);

            $entity = static::init()->createOrUpdate($entity);
        }

        RESULT:
        assert($entity instanceof ConfigInterface);

        return $entity->getValue();
    }

    /**
     * Init config repository
     */
    private static function init(): ConfigRepositoryInterface
    {
        return app(ConfigRepositoryInterface::class);
    }
}
