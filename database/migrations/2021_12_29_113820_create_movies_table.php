<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoviesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->string('title', 100)->nullable()->unique();
            $table->string('imdb_id', 100)->nullable()->unique();
            $table->string('slug', 100)->nullable();
            $table->string('year', 100)->nullable();
            $table->string('type', 100)->nullable();
            $table->string('length', 100)->nullable();
            $table->text('plot')->nullable();
            $table->string('rating', 100)->nullable();
            $table->string('rating_votes', 100)->nullable();
            $table->string('poster_url')->nullable();
            $table->string('thumbnail_url')->nullable();
            $table->jsonb('trailer')->nullable();
            $table->jsonb('cast')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('movies');
    }
}
