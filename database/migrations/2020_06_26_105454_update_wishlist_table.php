<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateWishlistTable extends Migration
{

    public function up()
    {
        Schema::table('wishlists', function (Blueprint $table) {
            $table->unique(["user_id", "product_id"], 'user_product_unique');
        });
    }

    public function down()
    {
        Schema::table('wishlists', function (Blueprint $table) {
          $table->dropUnique('user_product_unique');
        });
    }
}
