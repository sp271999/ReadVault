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
        Schema::table('transactions', function (Blueprint $table) {
            // ✅ Only add new columns that don't exist
            if (!Schema::hasColumn('transactions', 'borrowed_at')) {
                $table->date('borrowed_at')->nullable();
            }

            if (!Schema::hasColumn('transactions', 'due_date')) {
                $table->date('due_date')->nullable();
            }

            // ❌ Remove this — timestamps already exist in most tables
            // $table->timestamps();

            // ❌ Remove these — user_id and book_id already exist and likely already have foreign keys
            // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            // $table->foreign('book_id')->references('id')->on('books')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            // Drop the newly added columns on rollback
            if (Schema::hasColumn('transactions', 'borrowed_at')) {
                $table->dropColumn('borrowed_at');
            }
            if (Schema::hasColumn('transactions', 'due_date')) {
                $table->dropColumn('due_date');
            }
        });
    }
};
