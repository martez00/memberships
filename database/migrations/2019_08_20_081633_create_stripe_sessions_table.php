<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStripeSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stripe_sessions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->mediumText('session_id');
            $table->unsignedBigInteger('user_membership_id');

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
        Schema::dropIfExists('stripe_sessions');
    }
}
