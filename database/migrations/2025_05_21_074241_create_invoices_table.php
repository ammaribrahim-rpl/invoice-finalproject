<?php

// database/migrations/xxxx_xx_xx_xxxxxx_create_invoices_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('invoice_number')->unique();
            $table->string('client_name');
            $table->string('client_email');
            $table->text('client_address');
            $table->date('issue_date');
            $table->date('due_date');
            $table->decimal('total_amount', 10, 2);
            $table->enum('payment_status', ['unpaid', 'paid'])->default('unpaid');
            $table->foreignId('payment_method_id')->nullable()->constrained()->onDelete('set null');
            $table->timestamp('paid_at')->nullable();
            // Deskripsi item invoice bisa sebagai JSON atau tabel terpisah (invoice_items)
            // Untuk kesederhanaan, kita bisa tambahkan field deskripsi di sini
            $table->text('description')->nullable(); // Misal: Layanan Konsultasi Web
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};