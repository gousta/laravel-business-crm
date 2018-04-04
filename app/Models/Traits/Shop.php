<?php

namespace App\Models\Traits;

define('START_DATE', env('APP_START_DATE'));

trait Shop
{
    // This is the start date for the salon
    protected $startDate = START_DATE;

    public function scopeShop($query)
    {
        return $query->where('labor.date', '>=', $this->startDate);
    }
}
