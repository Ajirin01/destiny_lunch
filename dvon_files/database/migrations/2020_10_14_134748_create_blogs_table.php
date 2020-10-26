<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogsTable extends Migration
{
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('blog_owner_id');
            $table->string('blog_slug');
            $table->string('blog_title');
            $table->integer('blog_name_id')->unsigned();
            $table->foreign('blog_name_id')->references('id')->on('blog_names')->onDelete('cascade');
            $table->string('blog_image');
            $table->longText('blog_description');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('blogs');
    }
}
