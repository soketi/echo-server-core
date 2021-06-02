<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEchoAppsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('echo_apps', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('key')->index();
            $table->string('secret');
            $table->unsignedInteger('max_connections')->nullable();
            $table->boolean('enable_stats')->default(false);
            $table->boolean('enable_client_messages')->default(true);
            $table->unsignedInteger('max_backend_events_per_min')->nullable();
            $table->unsignedInteger('max_client_events_per_min')->nullable();
            $table->unsignedInteger('max_read_req_per_min')->nullable();
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
        Schema::dropIfExists('echo_apps');
    }
}
