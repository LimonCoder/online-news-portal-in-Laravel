<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('parent_id')->unsigned()->nullable();
            $table->string('name',50);
            $table->integer('type')->unsigned()->comment("1 = category, 2 = sub_category");
            $table->string('icon',100)->nullable();
            $table->integer('serial')->unsigned()->nullable();
            $table->tinyInteger('is_show')->unsigned()->comment('1= show, 0 = hide');
            $table->tinyInteger('is_feature')->unsigned()->comment('1 = featured, 0 = undeatured');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
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
        Schema::dropIfExists('categories');
    }
}
