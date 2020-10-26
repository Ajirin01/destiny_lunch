<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogNamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_names', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('blog_owner_id');
            $table->string('blog_name');
            $table->string('blog_logo');
            $table->string('blog_reference')->nullable();
            $table->integer('subscription_id')->nullable();
            $table->string('blog_status')->nullable();
            $table->string('expired')->nullable();
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
        Schema::dropIfExists('blog_names');
    }
}
