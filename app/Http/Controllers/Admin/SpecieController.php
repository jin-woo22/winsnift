<?php

namespace App\Http\Controllers\Admin;

use App\Models\Specie;
use App\Models\Category;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\Services\ImageUploadService;
use App\Http\Requests\Specie\SpecieRequest;
use App\Http\Resources\Specie\SpecieResource;
use Session;

class SpecieController extends Controller
{
    public function index(Request $request)
    {
        if(request()->ajax())
        {
            $species = SpecieResource::collection(
                Specie::query()
                ->with('category', 'media')
                ->latest()
                ->orderBy('scientific_name','asc')
                ->get()
            );

            return DataTables::of($species)
                   ->addIndexColumn()
                   ->addColumn('actions', function($row) {

                    $new_row = collect($row);
                    $route_show = route('admin.species.show', $new_row['id']);
                    $route_edit = route('admin.species.edit', $new_row['id']);

                    // <a class='dropdown-item' href='$route_show'>View</a>


                    $btn = "
                        <div class='dropdown'>
                            <a class='btn btn-sm btn-icon-only' href='#' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                <i class='fas fa-ellipsis-v'></i>
                            </a>
                            <div class='dropdown-menu dropdown-menu-right dropdown-menu-arrow'>
                                <a class='dropdown-item' href='$route_edit'>Edit</a>";

                               $btn .="<a class='dropdown-item' href='javascript:void(0)' onclick='c_destroy(`$new_row[id]`,`admin.species.destroy`,`.specie_dt`)'>Delete</a>
                            </div>
                        </div> ";
    
                    return $btn;
    
                   })
                   ->rawColumns(['actions'])
                   ->make(true);
        }

        return view('admin.specie.index');
    }

    public function create(Request $request)
    {

        if($request->query('platform')){
            return view('mobile.create_specie')->with('categories',Category::all());
        }

        return view('admin.specie.create', [
            'categories' => Category::all(),
        ]);
    }

    public function store(SpecieRequest $request, ImageUploadService $service)
    {
        $specie = Specie::create($request->validated());

        if($request->query('platform')){
            Session::flash('success', 'Species Added Successfully');
            return to_route('admin.species.create', ['platform' => 'mobile'])->with(['success' => 'Species Added Successfully']);       
        }

        return to_route('admin.species.index')->with(['success' => 'Species Added Successfully.']);
    }

    public function show(Specie $specie)
    {
        return view('admin.specie.show', [
            'specie' => $specie->load('brand', 'category', 'media'),
        ]);
    }

    public function edit(Specie $specie)
    {
        return view('admin.specie.edit', [
            'specie' => $specie,
            'categories' => Category::all(),
        ]);
    }

    public function update(SpecieRequest $request, Specie $specie, ImageUploadService $service)
    {
        $specie->update($request->validated());

        if($request->featured_photo) 
        {
            $service->handleImageUpload(model:$specie, images: $request->featured_photo, collection:'featured_photo', conversion_name:'card', action:'update');
        }
 
        return to_route('admin.species.index')->with(['success' => 'Specie Updated Successfully']);
    }

    
    public function destroy(Specie $specie)
    {
        $specie->delete();

       return $this->res(['success' => 'Specie Deleted Successfully']);
    }
}