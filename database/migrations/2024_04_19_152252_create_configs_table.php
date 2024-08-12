<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use TheBachtiarz\Config\Interfaces\Models\ConfigInterface;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create(ConfigInterface::TABLE_NAME, function (Blueprint $table) {
            $table->id();
            $table->string(ConfigInterface::ATTRIBUTE_PATH)->unique();
            $table->boolean(ConfigInterface::ATTRIBUTE_IS_ENCRYPT)->default(false);
            $table->string(ConfigInterface::ATTRIBUTE_VALUE, 800);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(ConfigInterface::TABLE_NAME);
    }
};
