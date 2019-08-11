<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExtendTokensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('extend_tokens', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->mediumText('token');
            $table->unsignedBigInteger('user_membership_id');
            $table->tinyInteger('used')->default(0);

            $table->foreign('user_membership_id')
                ->references('id')
                ->on('user_memberships')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('extend_tokens');
    }
}
