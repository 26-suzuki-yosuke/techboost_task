<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     
     // 名前(name)、性別(gender)、趣味(hobby)、自己紹介(introduction) を追記
    public function up()
    {
        Schema::create('profile', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name'); // ニュースのタイトルを保存するカラム
            $table->string('gender');  // ニュースの本文を保存するカラム
            $table->string('hobby')->nullable();  // ニュースの本文を保存するカラム
            $table->string('introduction')->nullable();  // 画像のパスを保存するカラム
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
        Schema::dropIfExists('profile');
    }
}
