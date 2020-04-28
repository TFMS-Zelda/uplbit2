<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComputersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('computers', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';  
            $table->collation = 'utf8_spanish_ci';
            
            $table->bigIncrements('id');

            $table->string('type_machine', 128 );
            $table->string('brand', 128 );
            $table->string('model', 128 );
            $table->string('servicetag', 128 )->unique();
            $table->string('servicecode', 128 );
            $table->string('operating_system', 128 );
            $table->string('hard_drive', 128 );
            $table->string('processor', 128 );
            $table->string('memory_ram', 64 );
            $table->string('charger_model', 128);
            $table->string('charger_serial', 128)->unique();

            $table->string('hostname', 128 )->unique();
            $table->string('workgroup', 128 );
            $table->string('domain_name', 128 );
            $table->string('license', 128 );
            $table->string('license_plate', 7)->unique();            
            $table->string('status', 64);
            $table->date('warranty_start');
            $table->date('warranty_end');
            
            //  Relation  a 1 , Table articles     
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
        Schema::dropIfExists('computers');
    }
}
