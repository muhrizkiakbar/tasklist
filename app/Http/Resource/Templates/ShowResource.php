<?php

namespace App\Http\Resource\Templates;

use App\Http\Resource\Templates\items\ItemsResource;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\Resource;

class ShowResource extends Resource
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
            'data' => [
                'id' => $this->id,
                'type' => "templates",
                'attributes' => [
                    'name'              => $this->name,
                    'checklist' => [
                        'description'  => $this->template_checklist->description,
                        'due_interval'       => $this->template_checklist->due_interval,
                        'due_unit'     => $this->template_checklist->due_unit,
                    ],
                    'items'     => ItemsResource::collection($this->template_items),
                ],
                'links' => [
                    'self' => $request->url()
                ]
                
            ],
                
                        
                
        ];
    }

}