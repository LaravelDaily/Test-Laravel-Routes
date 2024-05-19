<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSoftDeletesToUsersTable extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'deleted_at')) {
                $table->softDeletesDatetime('deleted_at')->nullable();
            }
        });
    }

    /*public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }*/
}
