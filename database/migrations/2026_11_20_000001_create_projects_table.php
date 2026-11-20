<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create("projects", function (Blueprint $table) {
            $table->id();
            $table->string("title");
            $table->string("slug")->unique();
            $table->string("summary");
            $table->text("description");
            $table->string("role")->nullable();
            $table->json("technologies")->nullable();
            $table->string("github_url")->nullable();
            $table->string("demo_url")->nullable();
            $table->unsignedInteger("position")->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists("projects");
    }
};
