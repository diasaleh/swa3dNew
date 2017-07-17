<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIndividualsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('individuals', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            
            $table->string('nameInEnglish')->nullable();
            $table->string('firstInEnglish')->nullable();
            $table->string('lastInEnglish')->nullable();

            $table->string('nameInArabic')->nullable();
            $table->string('firstInArabic')->nullable();
            $table->string('lastInArabic')->nullable();

            $table->boolean('rated')->unsigned()->default(0);
            $table->float('acc_avg')->unsigned()->default(0);
            $table->float('cat1')->unsigned()->default(0);
            $table->float('cat2')->unsigned()->default(0);
            $table->float('cat3')->unsigned()->default(0);
            $table->float('cat4')->unsigned()->default(0);
            $table->string('cityName');
            $table->string('country');
            $table->string('gender');
            $table->string('currentWork');
            $table->string('educationalLevel');
            $table->string('major')->nullable();
            $table->date('dateOfBirth');
            $table->string('email')->unique();
            $table->unsignedInteger('mobileNumber')->nullable()->unique();
            $table->string('address')->nullable();
            $table->string('picture')->default('default.png');
            $table->boolean('preVoluntary');
            $table->integer('voluntaryYears');
            $table->integer('researcher')->default(0);
            //$table->index('skills');
            //$table->index('intrests');
            //$table->index('qualifications'); Optional
            $table->datetime('availableFrom')->nullable();
            $table->datetime('availableTo')->nullable();
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
        Schema::drop('individuals');
    }
}
