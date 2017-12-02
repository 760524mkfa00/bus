<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParentChildTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::create('parents', function (Blueprint $table) {
//            $table->engine = 'InnoDB';
//            $table->increments('id');
//            $table->string('first_name', 30);
//            $table->string('last_name', 30);
//            $table->string('email');
//            $table->string('primary_phone', 20);
//            $table->string('secondary_phone', 20)->nullable();
//            $table->string('address', 100);
//            $table->string('city', 50);
//            $table->string('province', 50);
//            $table->string('postal_code', 10);
//            $table->text('comments')->nullable();
//            $table->boolean('accept_rules')->default(0);
//            $table->boolean('accept_video')->default(0);
//            $table->boolean('accept_email')->default(0);
//            $table->string('year', 4);
//            $table->timestamps();
//
//            $table->unique( ['email', 'year'] );
//        });

        Schema::create('grades', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('grade', 30);
            $table->timestamps();
        });

        Schema::create('schools', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('school', 50);
            $table->timestamps();
        });

        Schema::create('tags', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('tag', 50);
            $table->timestamps();
        });

        Schema::create('children', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('parent_id')->unsigned();
            $table->string('first_name', 30);
            $table->string('last_name', 30);
            $table->string('address', 100);
            $table->string('city', 50);
            $table->string('province', 50);
            $table->string('postal_code', 10);
            $table->integer('current_school_id')->unsigned();
            $table->integer('next_school_id')->unsigned();
            $table->integer('grade_id')->unsigned();
            $table->text('medical_information')->nullable();
            $table->string('international', 3)->default('no');
            $table->dateTime('int_start_date')->nullable();
            $table->dateTime('int_end_date')->nullable();
            $table->string('paid', 3)->default('no');
            $table->string('seat_assigned', 3)->default('no');
            $table->string('processed', 3)->default('no');
            $table->string('map_system_id')->nullable();
            $table->string('year', 4);
            $table->timestamps();

            $table->foreign('parent_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('current_school_id')->references('id')->on('schools')->onDelete('cascade');
            $table->foreign('next_school_id')->references('id')->on('schools')->onDelete('cascade');
            $table->foreign('grade_id')->references('id')->on('grades')->onDelete('cascade');
        });

        Schema::create('children_tags', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->unsignedInteger('children_id');
            $table->unsignedInteger('tag_id');
            $table->unique(['children_id', 'tag_id']);

            $table->foreign('children_id')->references('id')->on('children')->onDelete('cascade');
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
        });

        Schema::create('notifications', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('parent_id')->unsigned();
            $table->string('notification');
            $table->timestamps();

            $table->foreign('parent_id')->references('id')->on('users')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('children_tags');
        Schema::dropIfExists('children');
        Schema::dropIfExists('tags');
        Schema::dropIfExists('schools');
        Schema::dropIfExists('grades');
        Schema::dropIfExists('notifications');
        Schema::dropIfExists('parents');
    }
}
