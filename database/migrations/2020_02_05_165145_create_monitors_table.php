<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMonitorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('monitors', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';  
            $table->collation = 'utf8_spanish_ci';
            
            $table->bigIncrements('id');

            // Descripcion general
            $table->string('brand', 128);
            $table->string('model', 128);
            $table->string('serial', 128)->unique();
            $table->string('screen_type', 8);
            $table->string('screen_format', 8);
            $table->string('backlight', 8);
            $table->string('input_connector_type', 32);
            $table->string('maximum_resolution', 64);
            $table->string('power_supply', 64);
            $table->string('license_plate', 7)->unique();
            $table->string('location', 64);
            $table->string('status', 64);
            $table->date('warranty_start');
            $table->date('warranty_end');

           //  Relation 1 a 1 , Table articles     
            $table->bigInteger('article_id')->unsigned()->nullable();
            //Llave Foreign  Tabla articles
            $table->foreign('article_id')->references('id')->on('articles')
            ->onUpdate('cascade')
            ->onDelete('set null');
            
            //Relation 1 a 1 , Table users
            $table->bigInteger('user_id')->unsigned()->nullable();
             //Llave Foreign  Tabla users
            $table->foreign('user_id')->references('id')->on('users')
            ->onUpdate('cascade')
            ->onDelete('set null');
            
            $table->softDeletes();
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
        Schema::dropIfExists('monitors');
    }
}
