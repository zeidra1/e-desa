<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePeringkatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peringkat', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('alternatif_id')->unsigned();
          $table->double('nilai')->default(0);
          $table->string('jenis')->nullable();
          $table->double('peringkat')->default(0);
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
        Schema::dropIfExists('peringkat');
    }
}
