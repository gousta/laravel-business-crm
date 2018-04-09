<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class AlterVatRemoveTimestampsAddDate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \DB::table('vat')->truncate();

        Schema::table('vat', function ($table) {
            $table->date('date');
            $table->dropColumn(['created_at', 'updated_at']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \DB::table('vat')->truncate();

        Schema::table('vat', function ($table) {
            $table->timestamps();
        });
    }
}
