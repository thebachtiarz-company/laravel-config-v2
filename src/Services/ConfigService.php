<?php

namespace TheBachtiarz\Config\Services;

use TheBachtiarz\Base\DTOs\Services\ResponseDataDTO;
use TheBachtiarz\Base\Enums\Services\ResponseConditionEnum;
use TheBachtiarz\Base\Enums\Services\ResponseHttpCodeEnum;
use TheBachtiarz\Base\Enums\Services\ResponseStatusEnum;
use TheBachtiarz\Base\Services\AbstractService;
use TheBachtiarz\Config\Enums\Services\ConfigIsEncryptEnum;
use TheBachtiarz\Config\Interfaces\Models\ConfigInterface;
use TheBachtiarz\Config\Interfaces\Repositories\ConfigRepositoryInterface;
use TheBachtiarz\Config\Interfaces\Services\ConfigServiceInterface;

class ConfigService extends AbstractService implements ConfigServiceInterface
{
    /**
     * Constructor
     */
    public function __construct(
        protected ConfigRepositoryInterface $configRepository,
    ) {
        parent::__construct(response: new ResponseDataDTO());
    }

    // ? Public Methods

    /**
     * Get config
     */
    public function getConfig(string $pathName): ResponseDataDTO
    {
        try {
            $this->setResponse(new ResponseDataDTO(
                condition: ResponseConditionEnum::TRUE,
                status: ResponseStatusEnum::SUCCESS,
                httpCode: ResponseHttpCodeEnum::OK,
                message: 'Config value',
                data: $this->configRepository->getByPath($pathName)?->simpleListMap(),
            ));
        } catch (\Throwable $th) {
            $this->log($th, 'error');

            $this->setResponse(new ResponseDataDTO(
                message: $th->getMessage(),
            ));
        }

        return $this->getResponse();
    }

    /**
     * Create or update config
     */
    public function createOrUpdate(
        string $pathName,
        mixed $value,
        ?ConfigIsEncryptEnum $isEncrypt = null,
    ): ResponseDataDTO {
        try {
            $configEntity = $this->configRepository->throwIfNullEntity(false)->getByPath($pathName);

            if ($configEntity) {
                if ($isEncrypt) {
                    $configEntity->setIsEncrypt($isEncrypt === ConfigIsEncryptEnum::TRUE);
                }

                $configEntity->setValue($value);
            } else {
                $configEntity = app(ConfigInterface::class);
                assert($configEntity instanceof ConfigInterface);

                $configEntity->setPath($pathName);
                $configEntity->setIsEncrypt($isEncrypt === ConfigIsEncryptEnum::TRUE);
                $configEntity->setValue($value);
            }

            $this->setResponse(new ResponseDataDTO(
                condition: ResponseConditionEnum::TRUE,
                status: ResponseStatusEnum::SUCCESS,
                httpCode: ResponseHttpCodeEnum::OK,
                message: 'Create or update config',
                data: $this->configRepository->createOrUpdate($configEntity)?->simpleListMap(),
            ));
        } catch (\Throwable $th) {
            $this->log($th, 'error');

            $this->setResponse(new ResponseDataDTO(
                message: $th->getMessage(),
            ));
        }

        return $this->getResponse();
    }

    // ? Protected Methods

    // ? Private Methods

    // ? Getter Modules

    // ? Setter Modules
}
