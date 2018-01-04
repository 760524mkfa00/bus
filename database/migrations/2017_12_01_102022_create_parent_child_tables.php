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

        Schema::create('orders', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('parent_id')->unsigned();
            $table->string('order_number', 50);
            $table->string('school_year', 4);
            $table->double('paid_amount', 8.2)->default(0);
            $table->string('reference_number', 18)->nullable();
            $table->string('transaction_number', 20)->nullable();
            $table->string('card_type', 2)->nullable();
            $table->string('message', 100)->nullable();
            $table->string('auth_code', 8)->nullable();
            $table->date('transaction_date')->nullable();
            $table->timestamps();
            $table->foreign('parent_id')->references('id')->on('users')->onDelete('cascade');
        });

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

        Schema::create('discounts', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('discount', 50);
            $table->timestamps();
        });

        Schema::create('children', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('order_id')->unsigned();
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
            $table->text('student_note')->nullable();
            $table->string('international', 3)->default('no');
            $table->dateTime('int_start_date')->nullable();
            $table->dateTime('int_end_date')->nullable();
            $table->string('paid', 3)->default('no');
            $table->string('seat_assigned', 3)->default('no');
            $table->string('processed', 3)->default('no');
            $table->string('map_system_id')->nullable();
            $table->double('amount', 8.2)->default('0.00');
            $table->integer('discount_id')->unsigned()->nullable();
            $table->integer('discount_amount')->unsigned()->default('0');


            $table->timestamps();

            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->foreign('current_school_id')->references('id')->on('schools')->onDelete('cascade');
            $table->foreign('next_school_id')->references('id')->on('schools')->onDelete('cascade');
            $table->foreign('grade_id')->references('id')->on('grades')->onDelete('cascade');
            $table->foreign('discount_id')->references('id')->on('discounts')->onDelete('cascade');
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
        Schema::dropIfExists('orders');
        Schema::dropIfExists('parents');
        Schema::dropIfExists('discounts');
    }
}
