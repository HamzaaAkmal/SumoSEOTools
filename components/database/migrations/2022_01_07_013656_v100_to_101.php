<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class V100To101 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('generals', function (Blueprint $table) {
            $table->boolean('lazy_loading')->after('page_load')->default(true);
        });

        Schema::table('api_keys', function (Blueprint $table) {
            $table->longText('google_api_key')->after('moz_secret_key')->nullable();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
