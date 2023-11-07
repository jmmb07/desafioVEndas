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
        Schema::create('vendas', function (Blueprint $table) {
            $table->id();
            $table->float('valor_venda');
            $table->date('data_venda');
            $table->timestamps();
            $table->unsignedBigInteger('id_vendedor');

            $table->foreign('id_vendedor')
                  ->references('id')
                  ->on('users')
                  ->where('role', '=', 'vendedor');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendas');
    }
};
