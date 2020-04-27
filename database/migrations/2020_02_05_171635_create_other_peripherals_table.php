<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOtherPeripheralsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('other_peripherals', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';  
            $table->collation = 'utf8_spanish_ci';
            
            $table->bigIncrements('id');
            $table->string('type_device', 128);
            $table->string('type_other_peripherals', 128);
            $table->string('brand', 128);
            $table->string('model', 128);
          
            $table->string('serial', 128)->unique();
            $table->string('license_plate', 7)->nullable();
            $table->string('location', 128);
            $table->string('status', 128);
            $table->date('warranty_start')->nullable();
            $table->date('warranty_end')->nullable();
            $table->text('description_of_characteristics', 1024);

            $table->bigInteger('article_id')->unsigned();
            $table->foreign('article_id')->references('id')->on('articles')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')
            ->onUpdate('cascade');
            
            $table->text('observations_news', 1024);
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
        Schema::dropIfExists('other_peripherals');
    }
}
