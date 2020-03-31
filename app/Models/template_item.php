<?php

namespace App\Models;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;

class template_item extends Model
{
    //
    use Filterable;

    protected $fillable = [
        'description','urgency','due_interval','due_unit',
    ];
    //
    public function template()
    {
        return $this->belongsTo('App\Models\template');
    }
}