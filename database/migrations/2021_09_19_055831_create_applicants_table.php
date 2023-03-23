<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applicants', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("phone");
            $table->string("district")->nullable();
            $table->string("fb_id_link")->nullable();
            $table->string("age")->nullable();
            $table->string("gender")->nullable();
            $table->string("brand_use")->nullable();
            $table->string("onnano_brnad")->nullable();
            $table->longText("fb_link")->nullable();
            $table->longText("status")->nullable();
            $table->longText("fb_user_input")->nullable();
            $table->longText("multi_images")->nullable();
            $table->integer("serial")->nullable();
            $table->boolean("is_short_listed")->default(false);
            $table->boolean("is_active")->default(true);
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
        Schema::dropIfExists('applicants');
    }
}
