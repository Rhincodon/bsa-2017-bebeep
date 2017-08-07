<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTripsTable extends Migration {

	public function up()
	{
		Schema::create('trips', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('user_id')->unsigned()->index();
			$table->integer('vehicle_id')->unsigned();
			$table->datetime('start_at');
			$table->datetime('end_at');
			$table->decimal('price', 8,2);
			$table->integer('seats')->unsigned();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('trips');
	}
}