<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaintenancePrintersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maintenance_printers', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';  
            $table->collation = 'utf8_spanish_ci';

            $table->bigIncrements('id');
            $table->date('maintenance_date');
            $table->string('maintenance_type', 64);
            $table->text('maintenance_description', 512);
            $table->string('responsible_maintenance', 128);
            $table->text('observations', 512);
            $table->string('attachments', 128)->nullable()->unique();

            //  Relation 1 a 1 , Table articles     
            $table->bigInteger('printer_id')->unsigned()->nullable();
            //Llave Foreign  Tabla articles
            $table->foreign('printer_id')->references('id')->on('printers')
            ->onUpdate('cascade')
            ->onDelete('set null');
            
            //Relation 1 a 1 , Table users
            $table->bigInteger('user_id')->unsigned()->nullable();
             //Llave Foreign  Tabla users
            $table->foreign('user_id')->references('id')->on('users')
            ->onUpdate('cascade')
            ->onDelete('set null');

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
        Schema::dropIfExists('maintenance_printers');
    }
}
