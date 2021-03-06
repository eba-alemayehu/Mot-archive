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
            $table->bigIncrements('id');
            $table->string("worker_id")->unique();
            $table->integer("department_id");
            $table->string('first_name');
            $table->string('father_name');
            $table->string('g_father_name')->nullable();
            $table->string('email')->unique();
            $table->string("phone")->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->integer("role_id");
            $table->string("profile_pic")->nullable();
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
        Schema::dropIfExists('users');
    }
}
