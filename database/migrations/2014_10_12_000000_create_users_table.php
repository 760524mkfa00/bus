<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('first_name', 20);
            $table->string('last_name', 20);
            $table->string('email')->unique();
            $table->string('password', 60);
            $table->string('active', 3)->default('yes');
            $table->string('primary_phone', 30);
            $table->string('secondary_phone', 30)->nullable();
            $table->string('address', 100);
            $table->string('city', 50);
            $table->string('province', 50);
            $table->string('postal_code', 10);
            $table->text('comments')->nullable();
            $table->boolean('accept_rules')->default(0);
            $table->boolean('accept_video')->default(0);
            $table->boolean('accept_email')->default(0);
            $table->string('moneris_id')->nullable();
            $table->string('card_last_four')->nullable();

            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('roles', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name');
            $table->string('slug')->unique();
            $table->jsonb('permissions'); // jsonb deletes duplicates
            $table->timestamps();
        });

        Schema::create('role_users', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('role_id');
            $table->timestamps();
            $table->unique(['user_id','role_id']);
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('role_users');
        Schema::dropIfExists('roles');
        Schema::dropIfExists('users');
    }
}
