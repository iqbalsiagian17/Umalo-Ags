<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubKategorisTable extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('sub_kategoris')) {
            Schema::create('sub_kategoris', function (Blueprint $table) {
                $table->id();
                $table->string('nama');
                $table->foreignId('kategori_id')->constrained()->onDelete('cascade');
                $table->timestamps();
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('sub_kategoris');
    }
}

