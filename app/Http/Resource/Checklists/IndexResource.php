<?php

namespace App\Http\Resource\Checklists;
use App\Http\Resource\Checklists\items\ItemsResource;
use Illuminate\Support\Str;
use Illuminate\Http\Resources\Json\Resource;

class IndexResource extends Resource
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
        // dd($this->template_items());
        return 
        [
                    
                    'type'  => 'checklists',
                    'id'  => $this->id,
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
                        
                
        ];
    }

    /**
     * Create new resource collection.
     *
     * @param  mixed  $resource
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public static function collection($resource)
    {

        // return var_dump();
        $collection = parent::collection($resource)->collection;
        $wrap = Str::plural(self::$wrap);
        return [
            "meta"  =>  
                        [
                            "count" => $collection->count(),   
                            "total" => $resource->toArray()["total"],
                        ],
            "links"  =>
                        [
                            "first" => $resource->toArray()["first_page_url"],
                            "last" => $resource->toArray()["last_page_url"],
                            "next" => $resource->toArray()["next_page_url"],
                            "prev" => $resource->toArray()["prev_page_url"],
                        ],
            "data" => $collection
        ];
    }
}