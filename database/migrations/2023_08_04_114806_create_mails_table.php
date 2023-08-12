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
        Schema::create('mails', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('to');
            $table->string('from')->nullable();
            $table->string('subject');
            $table->longText('body');
            // $table->string('actionButton')->nullable();
            $table->longText('attachments')->nullable();
            $table->boolean('status')->nullable();
            $table->timestamps();
        });
    }
// 'to', 'from', 'subject', 'body', 'attachments', 'status'
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mails');
    }
};
