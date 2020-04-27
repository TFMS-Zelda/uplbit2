<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTabletsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tablets', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';  
            $table->collation = 'utf8_spanish_ci';
            
            $table->bigIncrements('id');
            $table->string('brand', 64);
            $table->string('model', 128);
            $table->string('color', 32);
            $table->string('serial', 128)->unique();
            $table->string('screen', 64);
            $table->string('processor', 64);
            $table->string('memory', 64);
            $table->string('camera', 64);
            $table->string('battery', 64);
            $table->string('operating_system', 128);
            $table->string('optical_pencil', 8);
            $table->string('charger_model', 128);
            $table->string('charger_serial', 128)->unique();
            $table->string('data_plan', 64);
            $table->string('sim_card', 64)->unique();
            $table->string('pin', 4);
            $table->string('imei', 16)->unique();
            $table->string('phone_number', 10)->unique();
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
        Schema::dropIfExists('tablets');
    }
}
