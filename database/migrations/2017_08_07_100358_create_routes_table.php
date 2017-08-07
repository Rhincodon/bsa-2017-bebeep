<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRoutesTable extends Migration {

	public function up()
	{
		Schema::create('routes', function(Blueprint $table) {
			$table->increments('id');
			$table->string('from');
			$table->string('to');
			$table->integer('trip_id')->unsigned()->index();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('routes');
	}
}