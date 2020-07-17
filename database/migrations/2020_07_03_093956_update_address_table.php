<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateAddressTable extends Migration
{
    public function up()
    {
        Schema::table('address', function (Blueprint $table) {
            $table->enum('type',array('permanent','shipping'))->nullable()->after('pincode');
        });
    }

    public function down()
    {
        Schema::table('address', function (Blueprint $table)
        {

            $table->dropColumn('type');

        });
    }
}
