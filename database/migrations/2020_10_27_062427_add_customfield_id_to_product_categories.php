<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCustomfieldIdToProductCategories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_categories', function (Blueprint $table) {
            $table->integer('custom_field_id')
                ->nullable()
                ->after('parent');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_categories', function (Blueprint $table) {
            //
        });
    }
}
