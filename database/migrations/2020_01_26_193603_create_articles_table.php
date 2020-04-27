<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';  
            $table->collation = 'utf8_spanish_ci';

            $table->bigIncrements('id');
            $table->string('area', 128);
            $table->date('invoice_date');
            $table->date('expiration_date');
            $table->string('remission', 128);
            $table->string('quotation', 128);
            $table->string('quantity', 128);
            $table->string('total_value', 128);
            $table->string('total_bill', 128);
            $table->string('total_in_letters', 512);
            $table->string('invoice_number', 128)->unique();
            $table->string('seller', 128);
            $table->string('digital_invoice')->unique();
            $table->text('observations', 1024);


            //Relacion 1 a N , Tabla provedors
            $table->bigInteger('provider_id')->unsigned();
            //Llave Foreign  Tabla provedors
            $table->foreign('provider_id')->references('id')->on('providers')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            
            
            //Relacion 1 a N , Tabla users
            $table->bigInteger('user_id')->unsigned();
            //Llave Foreign -> Tabla users
            $table->foreign('user_id')->references('id')->on('users')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            
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
        Schema::dropIfExists('articles');
    }
}
