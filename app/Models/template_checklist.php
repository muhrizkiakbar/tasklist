<?php

namespace App\Models;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;

class template_checklist extends Model
{
    use Filterable;

    
    protected $table="template_checklist";

    protected $fillable = [
        'description','due_interval','due_unit',
    ];
    //
    public function template()
    {
        return $this->belongsTo('App\Models\template');
    }
}