<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSlabsTable extends Migration
{
    public function up(): void
    {
        Schema::create('slabs', function(Blueprint $table){
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            $table->string('name');
            $table->string('order_number')->nullable();

            $table->text('description')->nullable();

            $table->integer('price')->nullable();
            $table->integer('quantity')->nullable();
            $table->integer('thickness')->nullable();
            $table->integer('width')->nullable();
            $table->integer('length')->nullable();
            $table->integer('square_meters')->nullable();


            $table->enum('supplier',
                ['Cosentino',
                 'Caesarstone',
                 'Diresco',
                 'Compac',])->nullable();

            $table->enum('brand',
                ['Cosentino',
                 'Caesarstone',
                 'Diresco',
                 'Compac',
                 'TheSize',
                 'Porcelanosa',
                 'Levantina',
                 'Laminam'])->nullable();

            $table->enum('finishing',
                ['Geschuurd',
                 'Gezoet',
                 'Gepolijst'])->nullable();

            $table->enum('type_stone',
                ['Granite',
                 'Composite',
                 'Neolith',
                 'Sensa',
                 'Marble',
                 'Quartz',
                 'Porcelain',
                 'Travertine',
                 'Onyx',
                 'Soapstone',
                 'Quartzite',
                 'Dekton',
                 'Silestone',
                 'Ceramic',
                 'Scalea'])->nullable();

            $table->enum('warehouse_position',
                [
                'A1', 'A2', 'A3', 'A4',
                'B1', 'B2', 'B3', 'B4',
                'C1', 'C2', 'C3', 'C4',
                'D1', 'D2', 'D3', 'D4'
            ])->nullable();


            $table->string('image')->nullable();
            $table->timestamps();
            $table->softDeletes();


        });
    }

    public function down(): void
    {
        Schema::dropIfExists('slabs');
    }
}
