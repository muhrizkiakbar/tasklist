<?php

namespace App\Http\Resource\Templates;
use App\Http\Resource\Templates\items\ItemsResource;
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
                    'attributes' => [
                        'name'              => $this->name,
                        'checklist' => [
                            'description'  => $this->template_checklist['description'],
                            'due_interval' => $this->template_checklist['due_interval'],
                            'due_unit'     => $this->template_checklist['due_unit'],
                        ],
                        'items'     => ItemsResource::collection($this->template_items),
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