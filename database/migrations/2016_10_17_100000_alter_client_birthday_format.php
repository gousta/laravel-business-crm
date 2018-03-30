<?php

use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;

class AlterClientBirthdayFormat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $clients = App\Models\Client::all();

        foreach ($clients as $client) {
            if (!empty($client->birthday)) {
                $client->birthday = Carbon::parse($client->birthday)->format('d/m/Y');
                $client->save();
            }
        }
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
