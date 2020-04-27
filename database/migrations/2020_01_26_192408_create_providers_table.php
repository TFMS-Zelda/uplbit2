<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProvidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('providers', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';  
            $table->collation = 'utf8_spanish_ci';

            $table->bigIncrements('id');
            $table->string('name', 128);
            $table->string('kind_of_society', 128);
            $table->string('nit', 9)->unique();
            $table->string('country', 128);
            $table->string('city', 128);
            $table->string('address', 128);
            $table->string('url', 128)->unique();
            $table->string('sales_representative', 128);
            $table->string('email_contact', 128)->unique();
            $table->string('phone_contact', 7)->unique();
            $table->string('extension_contact', 10);
            $table->string('billing_period', 128);
            $table->string('payment_type', 128);
            $table->date('creation_date');

            //Relation 1 a N , Table companies
            $table->bigInteger('company_id')->unsigned();
             //Llave Foreign  Tabla companies
            $table->foreign('company_id')->references('id')->on('companies')
            ->onUpdate('cascade');


            //Relation 1 a N , Table users
            $table->bigInteger('user_id')->unsigned();
             //Llave Foreign  Tabla users
            $table->foreign('user_id')->references('id')->on('users')
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
        Schema::dropIfExists('providers');
    }
}
