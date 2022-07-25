<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('mobile')->unique();
            $table->string('name')->nullable();
            $table->string('code')->nullable();
            $table->boolean('verified')->default(0)->comment('1:verified-0:not verified	');
            $table->boolean('level')->default(0)->comment('1:admin-0:user');
            $table->boolean('status')->default(1)->comment('1:active-0:not active');

            $table->string('password', 990)->nullable()->default(null);

            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();

            $table->softDeletes();
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
        Schema::dropIfExists('users');
    }
}
