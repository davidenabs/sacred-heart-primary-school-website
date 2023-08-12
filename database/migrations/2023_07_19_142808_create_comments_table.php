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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            // $table->foreign('parent_id')->references('id')->on('comments')->onDelete('cascade');
            // $table->foreignId('parent_id')->nullable()->constrained('comments');
            $table->foreignId('parent_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->string('reply_to_id')->nullable();
            $table->text('content');
            $table->integer('commentable_id')->unsigned();
            $table->string('commentable_type');
            $table->boolean('is_approve')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
