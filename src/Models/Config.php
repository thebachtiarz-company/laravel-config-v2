<?php

namespace TheBachtiarz\Config\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;
use TheBachtiarz\Base\Models\AbstractModel;
use TheBachtiarz\Config\Helpers\DataValueHelper;
use TheBachtiarz\Config\Interfaces\Models\ConfigInterface;
use TheBachtiarz\Config\Models\Factories\ConfigFactory;

class Config extends AbstractModel implements ConfigInterface
{
    /**
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        $this->setTable(self::TABLE_NAME);
        $this->fillable(self::ATTRIBUTE_FILLABLE);

        $this->modelFactory = ConfigFactory::class;

        parent::__construct($attributes);
    }

    // ? Public Methods

    public function valueFormatted(): Attribute
    {
        return Attribute::make(
            get: fn(): mixed => DataValueHelper::modifyValueToDiffType($this->getValue(), ['array' => fn($input): string => serialize($input)]),
        );
    }

    // ? Protected Methods

    /**
     * Casting attribute path
     */
    protected function path(): Attribute
    {
        return Attribute::make(
            set: fn(string $value): string => Str::replace(search: ' ', replace: '_', subject: $value),
        );
    }

    /**
     * Casting attribute value
     */
    protected function value(): Attribute
    {
        return Attribute::make(
            get: fn(string $value, array $attributes): mixed => @$attributes[self::ATTRIBUTE_IS_ENCRYPT]
                ? unserialize(Crypt::decrypt($value))
                : unserialize($value),
            set: fn(mixed $value, array $attributes): string => @$attributes[self::ATTRIBUTE_IS_ENCRYPT]
                ? Crypt::encrypt(serialize($value))
                : serialize($value),
        );
    }

    // ? Private Methods

    // ? Getter Modules

    /**
     * Get path
     */
    public function getPath(): string
    {
        return $this->{self::ATTRIBUTE_PATH};
    }

    /**
     * Get is encrypt
     */
    public function getIsEncrypt(): bool
    {
        return $this->{self::ATTRIBUTE_IS_ENCRYPT};
    }

    /**
     * Get value
     */
    public function getValue(): mixed
    {
        return $this->{self::ATTRIBUTE_VALUE};
    }

    // ? Setter Modules

    /**
     * Set path
     */
    public function setPath(string $path): self
    {
        $this->{self::ATTRIBUTE_PATH} = $path;

        return $this;
    }

    /**
     * Set is encrypt
     */
    public function setIsEncrypt(bool $isEncrypt): self
    {
        $this->{self::ATTRIBUTE_IS_ENCRYPT} = $isEncrypt;

        return $this;
    }

    /**
     * Set value
     */
    public function setValue(mixed $value): self
    {
        $this->{self::ATTRIBUTE_VALUE} = $value;

        return $this;
    }
}
