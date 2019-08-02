<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminRoleMenusWebAccessTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_role_menus_web_access', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('admin_role_id')->unsigned();
            $table->foreign('admin_role_id')->references('id')->on('admin_roles');
            $table->bigInteger('menu_web_id')->unsigned();
            $table->foreign('menu_web_id')->references('id')->on('menus_web');
            $table->tinyInteger('status');
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
        Schema::dropIfExists('admin_role_menus_web_access');
    }
}
