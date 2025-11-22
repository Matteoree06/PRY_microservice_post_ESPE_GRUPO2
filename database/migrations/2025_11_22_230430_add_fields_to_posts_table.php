<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            // Agregamos columnas necesarias
            $table->string('title', 255)->after('id');
            $table->text('content')->nullable()->after('title');
            $table->unsignedBigInteger('user_id')->index()->after('content');
            $table->boolean('published')->default(false)->after('user_id');
            $table->softDeletes()->after('updated_at');
        });
    }

    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn(['title', 'content', 'user_id', 'published']);
            $table->dropSoftDeletes();
        });
    }
};
