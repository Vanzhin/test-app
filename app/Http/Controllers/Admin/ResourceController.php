<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Resources\CreateRequest;
use App\Http\Requests\Resources\UpdateRequest;
use App\Models\Resource;
use Illuminate\Http\Request;

class ResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $resources = Resource::paginate(5);
        return view('admin.resources.index', [
            'resourcesList' => $resources,
            'fields' =>Resource::getAllFields('resources')
        ]);    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $resourceToCreate = Resource::$columnsToGet;
        return view('admin.resources.create', [
            'resourceFields' => $resourceToCreate,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request)
    {
        $data = $request->validated();
        if(key_exists('is_active', $data)){
            $is_active = 1;
        } else{
            $is_active = 0;
        }
        $created = Resource::create([
            'url' => $data['url'],
            'description' => $data['description'],
            'is_active' => $is_active,
        ]);
        if($created){

            return redirect()->route('admin.resources')->with('success', __('messages.admin.resources.created.success'));
        }
        return back()->with('error', __('messages.admin.resources.created.error'))->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param Resource $resource
     * @return \Illuminate\Http\Response
     */
    public function show(Resource $resource)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Resource $resource
     * @return \Illuminate\Http\Response
     */
    public function edit(Resource $resource)
    {
        return view('admin.resources.edit', [
            'resourceFields' => $resource::$columnsToGet,
            'resource' => $resource,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param Resource $resource
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Resource $resource)
    {
        $data = $request->validated();
        if(key_exists('is_active', $data)){
            $is_active = 1;
        } else{
            $is_active = 0;
        }

        $updated = $resource->fill([
            'url' => $data['url'],
            'description' => $data['description'],
            'is_active' => $is_active,
        ])->save();

        if($updated){
            return redirect()->route('admin.resources')->with('success', __('messages.admin.resources.updated.success'));
        }
        return back()->with('error', __('messages.admin.resources.updated.error'))->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Resource $resource
     * @return \Illuminate\Http\Response
     */
    public function destroy(Resource $resource)
    {
        $deleted = $resource->delete();
        if($deleted){
            return redirect()->route('admin.resources')->with('success', __('messages.admin.resources.deleted.success'));
        }
        return back()->with('error', __('messages.admin.resources.deleted.error'))->withInput();
    }
}
