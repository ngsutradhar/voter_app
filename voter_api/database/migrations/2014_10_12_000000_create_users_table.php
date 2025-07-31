<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id('id');
            $table->string('user_id')->unique();
            $table->string('user_name')->nullable(true);
            
            $table->string('password');
            $table->rememberToken();
            $table->bigInteger('is_user_approved')->default(0);
            $table->string('is_user_approved_by',50)->nullable(true);


            $table->bigInteger('user_cat_id')->unsigned();
            $table ->foreign('user_cat_id')->references('id')->on('user_categories');

              // create ledger Foreign Key

            //   $table->bigInteger('ledger_id')->unsigned()->nullable(true);
            //   $table ->foreign('ledger_id')->references('id')->on('ledgers');

            $table->tinyInteger('inforce')->default(1);
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
