<?php

namespace App\Http\Resource\Checklists;

use App\Http\Resource\Checklists\items\ItemsResource;
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
                'type' => "checklists",
                'attributes' => [
                    'object_domain'  => $this->checklist_attribute['object_domain'],
                    'description' => $this->checklist_attribute['description'],
                    'is_completed'     => $this->checklist_attribute['is_completed'],
                    'due'     => $this->checklist_attribute['due'],
                    'urgency'     => $this->checklist_attribute['urgency'],
                    'completed_at'     => $this->checklist_attribute['completed_at'],
                    'update_at'     => $this->checklist_attribute['update_at'],
                    'created_at'     => $this->checklist_attribute['created_at'],
                ],
                'links' => [
                    'self' => $request->url()
                ]
            ],
                
                        
                
        ];
    }

}