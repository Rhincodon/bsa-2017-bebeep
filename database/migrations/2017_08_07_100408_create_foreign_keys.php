<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateForeignKeys extends Migration {

	public function up()
	{
		Schema::table('vehicles', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('trips', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('trips', function(Blueprint $table) {
			$table->foreign('vehicle_id')->references('id')->on('vehicles')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('bookings', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('bookings', function(Blueprint $table) {
			$table->foreign('trip_id')->references('id')->on('trips')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('routes', function(Blueprint $table) {
			$table->foreign('trip_id')->references('id')->on('trips')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('booking_route', function(Blueprint $table) {
			$table->foreign('route_id')->references('id')->on('routes')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('booking_route', function(Blueprint $table) {
			$table->foreign('booking_id')->references('id')->on('bookings')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
	}

	public function down()
	{
		Schema::table('vehicles', function(Blueprint $table) {
			$table->dropForeign('vehicles_user_id_foreign');
		});
		Schema::table('trips', function(Blueprint $table) {
			$table->dropForeign('trips_user_id_foreign');
		});
		Schema::table('trips', function(Blueprint $table) {
			$table->dropForeign('trips_vehicle_id_foreign');
		});
		Schema::table('bookings', function(Blueprint $table) {
			$table->dropForeign('bookings_user_id_foreign');
		});
		Schema::table('bookings', function(Blueprint $table) {
			$table->dropForeign('bookings_trip_id_foreign');
		});
		Schema::table('routes', function(Blueprint $table) {
			$table->dropForeign('routes_trip_id_foreign');
		});
		Schema::table('booking_route', function(Blueprint $table) {
			$table->dropForeign('booking_route_route_id_foreign');
		});
		Schema::table('booking_route', function(Blueprint $table) {
			$table->dropForeign('booking_route_booking_id_foreign');
		});
	}
}