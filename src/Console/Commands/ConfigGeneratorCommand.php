<?php

namespace TheBachtiarz\Config\Console\Commands;

use TheBachtiarz\Base\Http\Console\Commands\AbstractCommand;
use TheBachtiarz\Config\Interfaces\Services\ConfigServiceInterface;

class ConfigGeneratorCommand extends AbstractCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'thebachtiarz:config:store';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Store all config into database';

    /**
     * Constructor
     */
    public function __construct(
        protected ConfigServiceInterface $configService,
    ) {
        $this->commandTitle = 'Store Config';

        parent::__construct();
    }

    protected function commandProcess(): bool
    {
        /** @var string[] $listConfigData */
        $listConfigData = config(key: 'tbconfig.stored_config_data', default: []);

        foreach ($listConfigData as $key => $configFile) {
            foreach (config($configFile) as $name => $value) {
                $this->configService->createOrUpdate(
                    pathName: sprintf('%s.%s', $configFile, $name),
                    value: $value,
                );
            }
        }

        return true;
    }
}
