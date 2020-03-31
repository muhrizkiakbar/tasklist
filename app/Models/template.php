<?php

namespace App\Models;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;

class template extends Model
{
    //
    use Filterable;


    // protected $table="templates";

    protected $fillable = [
        'name',
    ];

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */

    public function template_checklist()
    {
        return $this->hasOne('App\Models\template_checklist');
        // return $this->hasMany(User::class, 'author_id');
    }

    public function template_items()
    {
        return $this->hasMany('App\Models\template_item');
        // return $this->hasMany(User::class, 'author_id');
    }
}