<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->unsignedBigInteger('id');
            $table->string('title')->index();
            $table->longText('content');
            $table->unsignedBigInteger('author_id');
            $table->string('image')->nullable();
            $table->timestamps();
            $table->primary(['id', 'created_at']);
        });
        Schema::table('posts', function (Blueprint $table) {
            $table->bigIncrements('id')->change();
        });

        $partition = "ALTER TABLE posts
            PARTITION BY RANGE (UNIX_TIMESTAMP(created_at))
            (
                PARTITION p1 VALUES LESS THAN (UNIX_TIMESTAMP('2021-01-01')),
                PARTITION p2 VALUES LESS THAN (UNIX_TIMESTAMP('2022-01-01')),
                PARTITION p3 VALUES LESS THAN (UNIX_TIMESTAMP('2023-01-01')),
                PARTITION pmax VALUES LESS THAN MAXVALUE
            )";
        \Illuminate\Support\Facades\DB::statement($partition);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
