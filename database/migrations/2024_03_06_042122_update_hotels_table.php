<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('hotels', function (Blueprint $table) {
            $table->string('name');
            $table->string('address');
            $table->string('postcode');
            $table->string('city');
            $table->string('state');
            $table->unsignedBigInteger('country_id');
            $table->string('longitude');
            $table->string('latitude');
            $table->string('phone');
            $table->string('fax');
            $table->string('email');
            $table->string('currency');
            $table->string('accommodation_type');
            $table->string('category');
            $table->string('web');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hotels', function (Blueprint $table) {
            $table->dropColumn([
                'name',
                'address',
                'postcode',
                'city',
                'state',
                'country_id',
                'longitude',
                'latitude',
                'phone',
                'fax',
                'email',
                'currency',
                'accommodation_type',
                'category',
                'web'
            ]);
        });
    }
};
