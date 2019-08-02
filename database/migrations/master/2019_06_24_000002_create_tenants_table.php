<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTenantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tenants', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('subdomain')->unique();
            $table->unsignedBigInteger('db_connection');
            $table->foreign('db_connection')->references('id')->on('db_connections');
            $table->string('db_url')->nullable();
            $table->string('db_host')->nullable();
            $table->string('db_port', 4)->nullable();
            $table->string('db_name');
            $table->string('db_username')->nullable();
            $table->string('db_password')->nullable();
            $table->string('db_socket')->nullable();
            $table->string('db_foreign_keys')->nullable();
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
        Schema::dropIfExists('tenants');
    }
}
