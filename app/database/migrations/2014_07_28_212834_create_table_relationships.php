<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableRelationships extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		
        // Create pivot table connecting `books` and `tags`
		Schema::create('hospital_physician', function($table) {
 
			# AI, PK
			# none needed
 
			# General data...
			$table->integer('physician_id')->unsigned();
            $table->integer('hospital_id')->unsigned();
			
			
			# Define foreign keys...
			$table->foreign('physician_id')->references('id')->on('physicians');
            $table->foreign('hospital_id')->references('id')->on('hospitals');
			
			
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::table('hospital_physician', function($table) {
			$table->dropForeign('hospital_physician_physician_id_foreign'); # table_fields_foreign
			$table->dropForeign('hospital_physician_hospital_id_foreign');  # table_fields_foreign
		});

		Schema::drop('hospital_physician');
	}

}
