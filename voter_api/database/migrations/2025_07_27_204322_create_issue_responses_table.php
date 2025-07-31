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
        Schema::create('issue_responses', function (Blueprint $table) {
            $table->id();
            $table->string('issue_description')->nullable(true);
            $table->bigInteger('issue_deadline_days')->nullable(true)->default(0);

            $table->bigInteger('issue_resolve_status_id')->unsigned();
            $table ->foreign('issue_resolve_status_id')->references('id')->on('issue_resolve_statuses');
            $table->bigInteger('user_id')->unsigned();
            $table ->foreign('user_id')->references('id')->on('users');
            $table->bigInteger('issue_type_id')->unsigned();
            $table ->foreign('issue_type_id')->references('id')->on('issue_types');
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
        Schema::dropIfExists('issue_responses');
    }
};
