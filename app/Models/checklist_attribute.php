<?php

namespace App\Models;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;

class checklist_attribute extends Model
{
    //
    use Filterable;

    
    // protected $table="template_checklist";

    protected $fillable = [
        'object_domain','description','is_completed','due_unit','completed_at','urgency',
    ];

    //
    public function checklist()
    {
        return $this->belongsTo('App\Models\checklist');
    }
}