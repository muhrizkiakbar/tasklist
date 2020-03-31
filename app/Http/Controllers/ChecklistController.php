<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resource\Checklist\IndexResource;
use App\Http\Resource\Checklist\StoreResource;
use App\Http\Resource\Checklist\ShowResource;


use Illuminate\Support\Facades\Validator;
use App\Models\checklist;
use App\Models\checklist_attribute;

class ChecklistController extends Controller
{
    //
    public function index(Request $request)
    {
        
        $checklists = checklist::filter($request->all())->paginate(10);
        return IndexResource::collection($checklists);
    }

    public function store(Request $request)
    {
        
    }
}