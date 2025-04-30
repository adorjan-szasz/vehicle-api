<?php

use App\Enums\ConsumptionUnit;
use App\Enums\Currency;
use App\Enums\MileageUnit;
use App\Enums\VehicleType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();

            $table->enum('type', VehicleType::values())->index();
            $table->string('brand')->index();
            $table->string('model')->index();
            $table->year('year')->index();
            $table->decimal('engine_cc')->nullable();
            $table->string('fuel_type')->nullable();
            $table->boolean('is_hybrid')->default(false);
            $table->boolean('is_electric')->default(false);
            $table->decimal('price', 10, 2)->index();
            $table->enum('currency', Currency::values());
            $table->string('color')->nullable();
            $table->decimal('mileage', 10, 2)->nullable();
            $table->enum('mileage_unit', MileageUnit::values());
            $table->string('consumption')->nullable();
            $table->enum('consumption_unit', ConsumptionUnit::values())->nullable();
            $table->json('images')->nullable();
            $table->decimal('discount', 5, 2)->nullable();
            $table->integer('stock')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
