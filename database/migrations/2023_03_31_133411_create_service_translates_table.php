<?php

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
        Schema::create('service_translates', function (Blueprint $table) {
            $table->id();
            $table->foreignId("service_id")->constrained("services")->cascadeOnDelete();
            $table->string("lang", 10)->index();
            $table->foreign("lang")->references("code")->on("languages")->cascadeonDelete();
            $table->string("title", 255)->nullable();
            $table->text("description")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_translates');
    }
};
