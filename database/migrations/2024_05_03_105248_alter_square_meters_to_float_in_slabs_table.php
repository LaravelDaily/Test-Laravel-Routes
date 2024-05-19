<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterSquareMetersToFloatInSlabsTable extends Migration
{
	public function up(): void
	{
		Schema::table('slabs', function(Blueprint $table){
            $table->decimal('square_meters', 10, 2)->nullable()->change();
        });
	}

	public function down(): void
	{
		Schema::table('slabs', function(Blueprint $table){
            $table->integer('square_meters')->nullable()->change();
        });
	}
}
