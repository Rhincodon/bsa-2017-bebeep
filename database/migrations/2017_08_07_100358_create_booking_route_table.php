<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBookingRouteTable extends Migration {

	public function up()
	{
		Schema::create('booking_route', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('route_id')->unsigned()->index();
			$table->integer('booking_id')->unsigned()->index();
		});
	}

	public function down()
	{
		Schema::drop('booking_route');
	}
}