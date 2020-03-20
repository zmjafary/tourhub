<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->integer('user_id')->nullable();
            $table->string('title')->nullable();
            $table->enum('type', ['Ad', 'Social'])->default('Social');
            $table->integer('cost')->nullable();
            $table->integer('capacity')->nullable();
            $table->string('description')->nullable();
            $table->date('date_from')->nullable();
            $table->date('date_to')->nullable();
            $table->integer('bookings_count')->default(0);
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
        Schema::dropIfExists('scraps');
    }
}
