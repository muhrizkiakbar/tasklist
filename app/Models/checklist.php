<?php

namespace App\Models;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;

class checklist extends Model
{
    //
    use Filterable;


    // protected $table="templates";


    /**
     * The relations to eager load on every query.
     *
     * @var array
     */

    public function checklist_attribute()
    {
        return $this->hasOne('App\Models\checklist_attribute');
        // return $this->hasMany(User::class, 'author_id');
    }

}