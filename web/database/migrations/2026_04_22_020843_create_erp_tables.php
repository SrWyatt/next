<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->string('password');
            $table->string('email')->default('admin@sistema.com');
        });

        Schema::create('support', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->string('password');
            $table->string('area')->default('Soporte Técnico');
        });

        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->string('password');
            $table->string('email');
            $table->decimal('balance', 10, 2)->default(0.00);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('support');
        Schema::dropIfExists('admins');
    }
};
