<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderUserEmailsTable extends Migration
{
    public function up()
    {
        Schema::create('order_user_emails', function (Blueprint $table) {
            $table->id();
            $table->string('order_email');
            $table->string('user_email');
            $table->timestamps();

            // Đặt khóa ngoại
            $table->foreign('order_email')->references('email')->on('orders')->onDelete('cascade');
            $table->foreign('user_email')->references('email')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('order_user_emails');
    }
}

