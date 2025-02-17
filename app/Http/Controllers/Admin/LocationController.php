<?php

namespace App\Http\Controllers\Admin;

use App\Models\Location;
use App\Models\Plantation;
use App\Models\Specie;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\Http\Requests\Location\LocationRequest;
use App\Http\Resources\PlantResource;
use App\Services\ImageUploadService;
use Session;


class LocationController extends Controller
{
    public function index(Request $request)
    {
        if(request()->ajax())
        {
            $plants = PlantResource::collection(Location::with('specie')->get());
            return DataTables::of($plants)
                   ->addIndexColumn()
                   ->addColumn('actions', function($row1) {
                    $row = collect($row1);
                    $id = $row['id'];
                    $route_show = route('admin.locations.show', $id);
                    $route_edit = route('admin.locations.edit', $id);

                    // <a class='dropdown-item' href='$route_show'>View</a>

                    $btn = "
                        <div class='dropdown'>
                            <a class='btn btn-sm btn-icon-only text-light' href='#' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                            <i class='fas fa-ellipsis-v'></i>
                            </a>
                            <div class='dropdown-menu dropdown-menu-right dropdown-menu-arrow'>

                  
                                <a class='dropdown-item' href='$route_edit'>Edit</a>

                                <a class='dropdown-item' href='javascript:void(0)' onclick='c_destroy($id,`admin.locations.destroy`,`.location_dt`)'>Delete</a>
                            </div>
                        </div> ";
    
                    return $btn;
    
                   })
                   ->rawColumns(['actions'])
                   ->make(true);
        }

        return view('admin.location.index');
    }

    public function create(Request $request)
    {
        $species = Specie::all();

        if($request->query('platform')){
            return view('mobile.create')->with('species',$species);
        }
        return view('admin.location.create')->with('species',$species);
    }

    public function store(Request $r,LocationRequest $request, ImageUploadService $service)
    {   
        
        $location = Location::create($request->validated());

        if($request->image) 
        {
            $request->validate([
                'image'=>'required|mimes:jpg,jpeg,png,bmp',
            ]);
            
            $imageName = '';
            if ($image = $request->file('image')){
                $imageName = time().'-'.uniqid().'.'.$image->getClientOriginalExtension();
                $image->move('images/uploads', $imageName);
            }
            
            $location->image = $imageName;
            $location->save();
        }

        if($request->query('platform')){
            Session::flash('success', 'Mother Plant Register Successfully');
            return to_route('admin.locations.create', ['platform' => 'mobile'])->with(['success' => 'Mother Plant Register Successfully']);       
        }

        return to_route('admin.locations.index')->with(['success' => 'Mother Plant Register Successfully']);
    }

    public function show(Location $location)
    {
        return view('admin.location.show', [
            'location' => $location,
        ]);
    }

    public function edit(Location $location)
    {
        $species = Specie::all();
        return view('admin.location.edit', [
            'location' => $location,
            'species' => $species
        ]);
    }

    public function update(LocationRequest $request, Location $location)
    {

       $location->update($request->validated());

       return to_route('admin.locations.index')->with(['success' => 'Location Updated Successfully']);
    }

    public function destroy(Location $location)
    {
        $location->delete();

       return $this->res(['success' => 'Location Deleted Successfully']);
    }
}