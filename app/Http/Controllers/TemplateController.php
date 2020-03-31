<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resource\Templates\IndexResource;
use App\Http\Resource\Templates\StoreResource;
use App\Http\Resource\Templates\ShowResource;
// use App\Helpers\Filters\TemplateFilter;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use App\Models\template;
use App\Models\template_checklist;

class TemplateController extends Controller
{
    //

    public function index(Request $request)
    {
        
        $templates = template::filter($request->all())->paginate(10);
        // dd($templates);
        return IndexResource::collection($templates);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            "data.*.name" => 'required|string',
            "data.*.checklist.description" => 'required|string',
            "data.*.checklist.due_interval" => 'numeric',
            "data.*.checklist.due_unit" => 'string',
        ]);

        
        $template= template::create([
            'name' => $request->input('data.*.name')[0],
        ]);
        

        $template->template_checklist()->create([
            'description' => $request->input('data.*.checklist.description')[0],
            'due_interval' => $request->input('data.*.checklist.due_interval')[0],
            'due_unit' => $request->input('data.*.checklist.due_unit')[0],
        ]);
        
        foreach ($request->input('data.*.items.*') as $key => $value) {
            $template->template_items()->create([
                'description' => $value["description"],
                'due_interval' => $value["due_interval"],
                'due_unit' => $value["due_unit"],
            ]);
        }

        return (new StoreResource($template))
                ->response()
                ->header('Status', 201);
    }

    public function show(Request $request,$id)
    {
        // dd(Route::current());
        $template = template::findOrFail($id);
        // dd($template);
        return (new ShowResource($template));
    }

    public function update(Request $request,$id)
    {
        // dd(Route::current());
        $template = template::findOrFail($id);
        $template->update([
            'name' => $request->input('data.*.name')[0],
        ]);

        $template->template_checklist()->update([
            'description' => $request->input('data.*.checklist.description')[0],
            'due_interval' => $request->input('data.*.checklist.due_interval')[0],
            'due_unit' => $request->input('data.*.checklist.due_unit')[0],
        ]);
        
        $template->template_items()->delete();

        foreach ($request->input('data.*.items.*') as $key => $value) {
            $template->template_items()->create([
                'description' => $value["description"],
                'due_interval' => $value["due_interval"],
                'due_unit' => $value["due_unit"],
            ]);
        }
        // dd($template);
        return (new ShowResource($template));
    }

    public function destroy(Request $request, $id)
    {
        $template = template::findOrFail($id);
        $template->delete();
        
        return response(null, 204);
    }
}