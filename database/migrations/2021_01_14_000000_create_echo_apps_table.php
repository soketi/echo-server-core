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
            $table->json('allowed_origins')->nullable();
            $table->boolean('enable_stats')->default(false);
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
