<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
public function up()
{
    Schema::table('pengaduans', function (Blueprint $table) {
        $table->text('tanggapan')->nullable();
    });
}

public function down()
{
    Schema::table('pengaduans', function (Blueprint $table) {
        $table->dropColumn('tanggapan');
    });
}

};