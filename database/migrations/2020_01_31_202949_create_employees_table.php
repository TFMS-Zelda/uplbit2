<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';  
            $table->collation = 'utf8_spanish_ci';
            $table->bigIncrements('id');
            $table->string('name', 128);
            $table->string('citizenship_card', 10)->unique();
            $table->string('email_corporate', 128)->unique();
            $table->string('job_title', 128);
            $table->string('employee_type', 128);
            $table->string('ugdn', 8)->unique();
            $table->string('status', 64);
            $table->string('work_area', 64);
            $table->string('country', 64);
            $table->string('city', 64);
            $table->string('phone', 10)->unique();
            $table->string('profile_avatar')->default('employee-avatar-default.svg');
            $table->date('creation_date');

            $table->bigInteger('company_id')->unsigned()->nullable();
            $table->foreign('company_id')->references('id')->on('companies')
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
        Schema::dropIfExists('employees');
    }
}
