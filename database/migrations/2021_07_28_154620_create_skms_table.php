<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSKMSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('skms', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->string('classification_file', 128);
            $table->string('category_file', 128);
            $table->string('name_file', 128)->unique();
            $table->date('creation_date');
            $table->string('impact_level', 24);

            //Relation 1 a 1 , Table users
            $table->bigInteger('user_id')->unsigned()->nullable();
            //Llave Foreign  Tabla users
            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade')
                ->onDelete('set null');

            $table->string('code_file', 128)->unique();
            $table->string('status', 64);
            $table->string('digital_file', 128)->unique();

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
        Schema::dropIfExists('s_k_m_s');
    }
}
