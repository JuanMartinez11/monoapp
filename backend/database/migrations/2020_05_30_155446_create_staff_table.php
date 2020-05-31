<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('staff', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->string('phone');
            $table->string('country');
            $table->string('city');
            $table->string('address');
            $table->string('email')->unique();
            $table->string('linkfb');
            $table->string('linkin');
            $table->string('linkld');
            $table->string('industry');
            $table->string('photo_profile');
            $table->string('photo_id');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();

        });



    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('staff');
    }
}
