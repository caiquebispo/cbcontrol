<?php

use App\Models\Module;
use App\Models\Profile;
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
        Schema::create('module_profiles', function (Blueprint $table) {

            $table->id('id');
            $table->foreignIdFor(Module::class);
            $table->foreignIdFor(Profile::class);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('module_profiles');
    }
};
