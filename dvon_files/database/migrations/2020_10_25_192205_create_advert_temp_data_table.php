<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdvertTempDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advert_temp_data', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('email')->default(Null);
            $table->string('advert_set_reference')->default(Null);
            $table->integer('subscription_id ')->default(Null);
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
        Schema::dropIfExists('advert_temp_data');
    }
}
