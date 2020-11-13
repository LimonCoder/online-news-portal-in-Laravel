<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateCommentReplyMappingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comment_reply_mapping', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('post_id')->unsigned();
            $table->integer('comment_id')->unsigned()->nullable();
            $table->string("name",100);
            $table->string("email",50)->nullable();
            $table->text('comment');
            $table->tinyInteger('type')->unsigned()->comment("1 = comment, 2 = reply");
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->string('created_by',15);
            $table->string('created_by_ip',15);
            $table->timestamp('updated_at')->nullable();
            $table->string('updated_by_ip',15)->nullable();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comment_reply_mapping');
    }
}
