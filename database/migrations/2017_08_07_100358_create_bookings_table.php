<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBookingsTable extends Migration {

	public function up()
	{
		Schema::create('bookings', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('user_id')->unsigned()->index();
			$table->integer('trip_id')->unsigned()->index();
			$table->string('status');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('bookings');
	}
}