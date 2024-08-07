<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFlagToSubKategorisTable extends Migration
{
    public function up()
    {
        Schema::table('sub_kategoris', function (Blueprint $table) {
            $table->enum('flag', ['yes', 'no'])->default('yes')->after('kategori_id');
        });
    }

    public function down()
    {
        Schema::table('sub_kategoris', function (Blueprint $table) {
            $table->dropColumn('flag');
        });
    }
}
