<?php

namespace TheBachtiarz\Config\Interfaces\Models;

use TheBachtiarz\Base\Interfaces\Models\ModelInterface;

interface ConfigInterface extends ModelInterface
{
    /**
     * Model table name
     */
    public const string TABLE_NAME = 'thebachtiarz_configs';

    /**
     * Attributes fillable
     */
    public const array ATTRIBUTE_FILLABLE = [
        self::ATTRIBUTE_PATH,
        self::ATTRIBUTE_IS_ENCRYPT,
        self::ATTRIBUTE_VALUE,
    ];

    public const string ATTRIBUTE_PATH = 'path';
    public const string ATTRIBUTE_IS_ENCRYPT = 'is_encrypt';
    public const string ATTRIBUTE_VALUE = 'value';

    // ? Getter Modules

    /**
     * Get path
     */
    public function getPath(): string;

    /**
     * Get is encrypt
     */
    public function getIsEncrypt(): bool;

    /**
     * Get value
     */
    public function getValue(): mixed;

    // ? Setter Modules

    /**
     * Set path
     */
    public function setPath(string $path): self;

    /**
     * Set is encrypt
     */
    public function setIsEncrypt(bool $isEncrypt): self;

    /**
     * Set value
     */
    public function setValue(mixed $value): self;
}
