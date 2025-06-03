<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('services', function (Blueprint $table) {
            $table->string('id', 7)->primary();
            $table->string('nama', 50);
            $table->text('kalimat_promosi');
            $table->text('deskripsi');
            $table->enum('satuan', ['Meter Persegi', 'Meter', 'Jam', 'Unit', 'Pasang', 'Dudukan']);
            $table->integer('harga');
            $table->string('category_id', 3); 
            $table->string('gambar', 50);
            $table->foreign('category_id')->references('id')->on('categories')->onUpdate('cascade')->onDelete('restrict');
            $table->timestamps();
            $table->boolean('status_del')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
