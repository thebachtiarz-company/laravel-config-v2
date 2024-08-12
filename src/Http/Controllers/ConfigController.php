<?php

namespace TheBachtiarz\Config\Http\Controllers;

use Illuminate\Http\JsonResponse;
use TheBachtiarz\Base\Http\Controllers\AbstractController;
use TheBachtiarz\Config\Enums\Services\ConfigIsEncryptEnum;
use TheBachtiarz\Config\Http\Requests\ConfigCreateRequest;
use TheBachtiarz\Config\Http\Requests\ConfigGetRequest;
use TheBachtiarz\Config\Http\Requests\Rules\ConfigIsEncryptRule;
use TheBachtiarz\Config\Http\Requests\Rules\ConfigPathRule;
use TheBachtiarz\Config\Http\Requests\Rules\ConfigValueRule;
use TheBachtiarz\Config\Interfaces\Services\ConfigServiceInterface;

class ConfigController extends AbstractController
{
    /**
     * Constructor
     */
    public function __construct(
        protected ConfigServiceInterface $configService,
    ) {
        parent::__construct();
    }

    /**
     * Get config
     *
     * @param ConfigGetRequest $request
     * @return JsonResponse
     */
    public function getConfig(ConfigGetRequest $request): JsonResponse
    {
        $this->configService->getConfig(pathName: $request->input(key: ConfigPathRule::PATH));

        return $this->getJsonResponse();
    }

    /**
     * Create or update config
     *
     * @param ConfigCreateRequest $request
     * @return JsonResponse
     */
    public function createOrUpdate(ConfigCreateRequest $request): JsonResponse
    {
        $this->configService->createOrUpdate(
            pathName: $request->input(key: ConfigPathRule::PATH),
            value: $request->input(key: ConfigValueRule::VALUE),
            isEncrypt: $request->enum(key: ConfigIsEncryptRule::ENCRYPT, enumClass: ConfigIsEncryptEnum::class),
        );

        return $this->getJsonResponse();
    }
}
