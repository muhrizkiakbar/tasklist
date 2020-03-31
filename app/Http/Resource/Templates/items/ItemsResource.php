<?php

namespace App\Http\Resource\Templates\items;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\Resource;

class ItemsResource extends Resource
{
    /**
     * The "data" wrapper that should be applied.
     *
     * @var string
     */
    // public static $wrap = "";

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return 
        [
                'description'  => $this->description,
                'urgency'       => $this->urgency,
                'due_interval'  => $this->due_interval,
                'due_unit'     => $this->due_unit,   
        ];
    }

}