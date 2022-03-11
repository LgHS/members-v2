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
        if(!Schema::hasTable('badges')) {
            Schema::create('badges', function (Blueprint $table) {
                $table->id('id');
                $table->text('user_id', 128);
                $table->text('roles_ids', 1024);
                $table->integer('is_banned');
                $table->text('welcome_name', 64);
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('badges');
    }
};
