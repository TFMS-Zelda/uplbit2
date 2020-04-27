<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrintersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('printers', function (Blueprint $table) {

            $table->engine = 'InnoDB';
            $table->charset = 'utf8';  
            $table->collation = 'utf8_spanish_ci';
            
            $table->bigIncrements('id');

            $table->string('brand', 128);
            $table->string('model', 128);
            $table->string('serial', 128)->unique();            ;
            $table->string('printer_functions', 128);
            $table->string('resolution', 128);
            $table->string('cpu', 128);
            $table->string('memory', 128);
            $table->string('hard_disk', 128);
            $table->string('paper_sources', 128);
            $table->string('input_capacity', 128);
            $table->string('output_capacity', 128);

            $table->string('license_plate', 7)->unique();
            $table->string('location', 128);
            $table->macAddress('mac_adrress')->unique();
            $table->ipAddress('ip_address')->unique();	

            $table->string('status', 128);
            $table->date('warranty_start');
            $table->date('warranty_end');
           
            $table->bigInteger('article_id')->unsigned();
            $table->foreign('article_id')->references('id')->on('articles')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')
            ->onUpdate('cascade');

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
        Schema::dropIfExists('printers');
    }
}
