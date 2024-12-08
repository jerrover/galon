<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminLoginTable extends Migration
{
    public function up()
    {
        Schema::create('admin_login', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->string('password');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('admin_login');
    }
} 