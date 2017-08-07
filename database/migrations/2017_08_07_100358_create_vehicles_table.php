<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateVehiclesTable extends Migration {

	public function up()
	{
		Schema::create('vehicles', function(Blueprint $table) {
			$table->increments('id');
			$table->string('brand');
			$table->string('model');
            $table->string('color');
			$table->integer('year')->unsigned();
			$table->string('body');
            $table->integer('seats');
			$table->string('photo')->nullable();
            $table->integer('user_id')->unsigned()->index();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('vehicles');
	}
}