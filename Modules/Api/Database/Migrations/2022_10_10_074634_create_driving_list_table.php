<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDrivingListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('driving_list', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained('vehicle_user')->onDelete('cascade');
            $table->foreignId('vehicle_id')->constrained('vehicle')->onDelete('cascade');

            $table->timestamp('start_at');
            $table->timestamp('finish_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('driving_list');
    }
}
