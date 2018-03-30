<?php

namespace App\Models\Traits;

trait Shop
{
    // This is the start date for the salon
    protected $dateStart = '2016-10-11';

    public function scopeShop($query)
    {
        return $query->where('labor.date', '>=', $this->dateStart);
    }
}
