<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'clients';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'surname',
        'email',
        'phone',
        'gender',
        'notes',
        'birthday',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];

    public function labor()
    {
        return $this->hasMany('App\Models\Labor', 'client_id', 'id');
    }

    public function getNameAttribute($v)
    {
        return !empty($v) ? $v : null;
    }

    public function setNameAttribute($v)
    {
        $this->attributes['name'] = !empty($v) ? ucfirst($v) : null;
    }

    public function getSurnameAttribute($v)
    {
        return !empty($v) ? $v : null;
    }

    public function setSurnameAttribute($v)
    {
        $this->attributes['surname'] = !empty($v) ? ucfirst($v) : null;
    }

    public function getEmailAttribute($v)
    {
        return !empty($v) ? $v : null;
    }

    public function getPhoneAttribute($v)
    {
        return !empty($v) ? $v : null;
    }

    public function setPhoneAttribute($v)
    {
        $this->attributes['phone'] = !empty($v) ? $v : null;
    }

    public function getGenderAttribute($v)
    {
        return !empty($v) ? $v : null;
    }

    public function setGenderAttribute($v)
    {
        $this->attributes['gender'] = !empty($v) ? $v : null;
    }

    public function getNotesAttribute($v)
    {
        return !empty($v) ? $v : null;
    }

    public function setNotesAttribute($v)
    {
        $this->attributes['notes'] = !empty($v) ? $v : null;
    }

    public function getBirthdayAttribute($v)
    {
        return !empty($v) ? $v : null;
    }

    public function setBirthdayAttribute($v)
    {
        $this->attributes['birthday'] = !empty($v) ? $v : null;
    }

    public function getGenderPrintAttribute($v)
    {
        switch ($this->gender) {
            case 'male':   return 'Άνδρας'; break;
            case 'female': return 'Γυναίκα'; break;
            default:       return '-'; break;
        }
    }
}
