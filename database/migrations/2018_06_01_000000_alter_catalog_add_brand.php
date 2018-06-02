<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class AlterCatalogAddBrand extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('catalog', function ($table) {
            $table->string('brand')->nullable();
        });

        $re = '/\(([^\)]+)\)/';

        $items = \App\Models\Catalog::where('cat', 'ΠΡΟΙΟΝΤΑ')->get();
        foreach($items as $item) {
            preg_match($re, $item->name, $matches, PREG_OFFSET_CAPTURE, 0);

            if(isset($matches[0], $matches[0][0])) {
                $item->name = trim(str_replace($matches[0][0], '', $item->name));
            }

            if(isset($matches[1], $matches[1][0])) {
                $item->brand = trim($matches[1][0]);
            }
            
            $item->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('catalog', function ($table) {
            $table->dropColumn(['brand']);
        });
    }
}
