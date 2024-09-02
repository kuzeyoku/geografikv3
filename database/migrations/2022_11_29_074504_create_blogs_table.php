<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\StatusEnum;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->string("slug", 255);
            $table->integer("category_id")->nullable()->default(0);
            $table->integer("order")->default(0);
            $table->enum("status", StatusEnum::getValues())->default(StatusEnum::Active->value);
            $table->integer("view_count")->default(0);
            $table->foreignId("user_id")->constrained("users")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};
