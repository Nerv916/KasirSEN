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
        Schema::create('pertamina_trxes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // kasir/operator
            $table->string('jenis_bbm');
            $table->decimal('liter', 8, 2);
            $table->decimal('harga_per_liter', 12, 2);
            $table->decimal('total', 12, 2);
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pertamina_trxes');
    }
};
