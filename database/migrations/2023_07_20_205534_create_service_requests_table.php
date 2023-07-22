<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_requests', function (Blueprint $table) {
            $table->id();
            $table->string('status');
            $table->unsignedBigInteger('user_id');
            $table->smallInteger('destination_longitude');
            $table->smallInteger('destination_latitude');
            $table->string('sender_name');
            $table->string('receiver_name');
            $table->string('receiver_number');
            $table->string('sender_number');
            $table->tinyInteger('source_longitude');
            $table->tinyInteger('source_latitude');
            $table->string('source_address');
            $table->string('destination_address');
            $table->string('uuid');
            $table->string('webhook_url');
            $table->timestamps();

            $table->foreign('user_id')->on('users')
                ->references('id')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('service_requests');
    }
};
