<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('voter_issues', function (Blueprint $table) {
            $table->id();
            $table->string('issue_description')->nullable(true);
            $table->string('address')->nullable(true);
            $table->string('municipality_gram_name')->nullable(true);
            $table->bigInteger('ward_no')->nullable(true)->default(0);

            $table->string('image_1')->nullable(true);
            $table->string('image_2')->nullable(true);
            $table->string('image_3')->nullable(true);
            $table->string('image_4')->nullable(true);
            $table->string('image_5')->nullable(true);


            $table->bigInteger('user_id')->unsigned();
            $table ->foreign('user_id')->references('id')->on('users');
            $table->bigInteger('issue_type_id')->unsigned();
            $table ->foreign('issue_type_id')->references('id')->on('issue_types');

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
        Schema::dropIfExists('voter_issues');
    }
};
