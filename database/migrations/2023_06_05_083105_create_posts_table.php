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
            $table->date('creation_date');
            $table->primary(['id', 'creation_date']);
        });
        Schema::table('posts', function (Blueprint $table) {
            $table->bigIncrements('id')->change();
        });
        $partition = "ALTER TABLE posts
            PARTITION BY RANGE (TO_DAYS(creation_date))
            (
                PARTITION part1 VALUES LESS THAN( TO_DAYS('2021-01-01') ),
                PARTITION part2 VALUES LESS THAN( TO_DAYS('2022-01-01') ),
                PARTITION part3 VALUES LESS THAN( TO_DAYS('2023-03-01') ),
                PARTITION part4 VALUES LESS THAN( TO_DAYS('2024-04-01') ),
                PARTITION part5 VALUES LESS THAN( TO_DAYS('2025-05-01') )

            )


           ";
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
