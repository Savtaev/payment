<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('phone_number')->default(0)->after('email');
            $table->unsignedBigInteger('account')->default('0')->after('email');
            $table->unsignedBigInteger('account_number')->default('0')->after('email');
            $table->unsignedBigInteger('BIN')->default('0')->after('email');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            Schema::dropColumns('users', ['phone_number','account','account_number','BIN']);
        });
    }
};
