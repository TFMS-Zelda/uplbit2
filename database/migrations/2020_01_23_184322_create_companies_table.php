<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';  
            $table->collation = 'utf8_spanish_ci';

            $table->bigIncrements('id');
            $table->string('name', 128);
            $table->string('kind_of_society', 128);
            $table->string('nit', 9)->unique();
            $table->string('country', 128);
            $table->string('city', 64);
            $table->string('address', 128);
            $table->string('url', 128)->unique();
            $table->string('person_contact', 128);
            $table->string('email_contact', 128)->unique();
            $table->string('phone_contact', 7)->unique();
            $table->string('extension_contact', 10);
            $table->date('creation_date');
            
            //Relation 1 a N , Table users
            $table->bigInteger('user_id')->unsigned();
             //Llave Foreign  Tabla users
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
        Schema::dropIfExists('companies');
    }
}
