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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }


    //create project laravel di C:\xampp\htdocs
    // tarok di htdocs
    // VVV
    // https://laravel.com/docs/10.x/installation
    // composer create-project laravel/laravel:^10.0 example-app
    // ke env cek DB


    //php artisan route:list
    //php artisan make:migration create_flights_table
    //php artisan migrate
    //php artisan make:seeder UserSeeder
    //php artisan db:seed
    //php artisan make:controller PhotoController --resource --model=Hotel
    //php artisan make:model Product
};
