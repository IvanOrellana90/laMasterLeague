<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groups', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->text('alert')->nullable();
            $table->integer('user_id');
            $table->integer('tournament_id');
            $table->boolean('active')->default(true);
            $table->timestamps();
        });

        Schema::create('group_user', function (Blueprint $table) {
            $table->integer('group_id');
            $table->integer('user_id');
            $table->boolean('active')->default(false);
            $table->primary(['user_id', 'group_id']);
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
        Schema::dropIfExists('groups');
        Schema::dropIfExists('group_user');
    }
}
