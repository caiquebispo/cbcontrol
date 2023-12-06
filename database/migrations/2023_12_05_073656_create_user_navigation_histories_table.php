<?php

use App\Models\UserLoginHistory;
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
        Schema::create('user_navigation_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(UserLoginHistory::class);
            $table->dateTime('date')->nullable();
            $table->string('functionality')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_navigation_histories');
    }
};
