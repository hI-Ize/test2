<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function contactPerson()
    {

        return $this->hasMany(ContactPerson::class);
    }

    /**
     * Returns key => value pairs that were actually changed
     *
     * @param array $fields_new
     * @return array
     */
    public function compare($fields_new = [])
    {
        $altered = [];

        foreach ($fields_new as $key => $val){

            if (isset($this->$key) && ($this -> $key != $val)){
                $altered[$key] = $val;
            }
        }

        return $altered;

    }


}
