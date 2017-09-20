<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReceiptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receipts', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('confirmed')->default(0);
            $table->string('name')->default('');
            $table->string('image');
            $table->string('class')->default('');
            $table->string('date_time')->default('');
            $table->string('establishment')->default('');
            $table->string('currency')->default('');
            $table->string('country')->default('');
            $table->string('language')->default('');
            $table->float('subtotal', 8, 2)->nullable();
            $table->float('tax', 8, 2)->nullable();
            $table->float('total', 8, 2)->nullable();
            $table->float('cash', 8, 2)->nullable();
            $table->float('change', 8, 2)->nullable();
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
        Schema::dropIfExists('receipts');
    }
}
