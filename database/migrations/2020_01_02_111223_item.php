<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Item extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('api_name')->unique();
            $table->text('explain')->nullable();
            $table->string('method');
            $table->string('db_name');
            $table->string('db_table');
            $table->text('db_table_col');
            $table->string('created_user')->nullable();
            $table->string('required1')->nullable();
            $table->string('required2')->nullable();
            $table->string('required3')->nullable();
            $table->string('required4')->nullable();
            $table->string('required5')->nullable();
            $table->string('required6')->nullable();
            $table->string('required7')->nullable();
            $table->string('required8')->nullable();
            $table->string('required9')->nullable();
            $table->string('required10')->nullable();
            $table->text('required_text1')->nullable();
            $table->text('required_text2')->nullable();
            $table->text('required_text3')->nullable();
            $table->text('required_text4')->nullable();
            $table->text('required_text5')->nullable();
            $table->text('required_text6')->nullable();
            $table->text('required_text7')->nullable();
            $table->text('required_text8')->nullable();
            $table->text('required_text9')->nullable();
            $table->text('required_text10')->nullable();
            $table->string('param1')->nullable();
            $table->string('param2')->nullable();
            $table->string('param3')->nullable();
            $table->string('param4')->nullable();
            $table->string('param5')->nullable();
            $table->string('param6')->nullable();
            $table->string('param7')->nullable();
            $table->string('param8')->nullable();
            $table->string('param9')->nullable();
            $table->string('param10')->nullable();
            $table->string('param11')->nullable();
            $table->string('param12')->nullable();
            $table->string('param13')->nullable();
            $table->string('param14')->nullable();
            $table->string('param15')->nullable();
            $table->string('param16')->nullable();
            $table->string('param17')->nullable();
            $table->string('param18')->nullable();
            $table->string('param19')->nullable();
            $table->string('param20')->nullable();
            $table->string('param21')->nullable();
            $table->string('param22')->nullable();
            $table->string('param23')->nullable();
            $table->string('param24')->nullable();
            $table->string('param25')->nullable();
            $table->string('param26')->nullable();
            $table->string('param27')->nullable();
            $table->string('param28')->nullable();
            $table->string('param29')->nullable();
            $table->string('param30')->nullable();
            $table->text('param_text1')->nullable();
            $table->text('param_text2')->nullable();
            $table->text('param_text3')->nullable();
            $table->text('param_text4')->nullable();
            $table->text('param_text5')->nullable();
            $table->text('param_text6')->nullable();
            $table->text('param_text7')->nullable();
            $table->text('param_text8')->nullable();
            $table->text('param_text9')->nullable();
            $table->text('param_text10')->nullable();
            $table->text('param_text11')->nullable();
            $table->text('param_text12')->nullable();
            $table->text('param_text13')->nullable();
            $table->text('param_text14')->nullable();
            $table->text('param_text15')->nullable();
            $table->text('param_text16')->nullable();
            $table->text('param_text17')->nullable();
            $table->text('param_text18')->nullable();
            $table->text('param_text19')->nullable();
            $table->text('param_text20')->nullable();
            $table->text('param_text21')->nullable();
            $table->text('param_text22')->nullable();
            $table->text('param_text23')->nullable();
            $table->text('param_text24')->nullable();
            $table->text('param_text25')->nullable();
            $table->text('param_text26')->nullable();
            $table->text('param_text27')->nullable();
            $table->text('param_text28')->nullable();
            $table->text('param_text29')->nullable();
            $table->text('param_text30')->nullable();
            $table->string('group_by1')->nullable();
            $table->string('group_by2')->nullable();
            $table->string('group_by3')->nullable();
            $table->string('group_by4')->nullable();
            $table->string('group_by5')->nullable();
            $table->string('group_by6')->nullable();
            $table->string('group_by7')->nullable();
            $table->string('group_by8')->nullable();
            $table->string('group_by9')->nullable();
            $table->string('group_by10')->nullable();
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
        Schema::dropIfExists('item');
    }
}
