<?php

namespace App\Http\Controllers\Admin;

use App\Models\Plantation;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\Http\Requests\Plantation\PlantationRequest;
use App\Http\Resources\Plantation\PlantationResource;
use App\Models\Location;
use App\Models\Specie;

class PlantationController extends Controller
{
    public function index(Request $request)
    {
        if(request()->ajax())
        {
            $plantations = PlantationResource::collection(Plantation::with('specie', 'location')->get());

            return DataTables::of($plantations)
                   ->addIndexColumn()
                   ->addColumn('actions', function($row) {

                    $new_row = collect($row);

                    $route_show = route('admin.plantations.show', $new_row['id']);
                    $route_edit = route('admin.plantations.edit', $new_row['id']);

                    $btn = "
                        <div class='dropdown'>
                            <a class='btn btn-sm btn-icon-only text-light' href='#' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                            <i class='fas fa-ellipsis-v'></i>
                            </a>
                            <div class='dropdown-menu dropdown-menu-right dropdown-menu-arrow'>

                            <a class='dropdown-item' href='$route_show'>View</a>

                                <a class='dropdown-item' href='$route_edit'>Edit</a>

                                <a class='dropdown-item' href='javascript:void(0)' onclick='c_destroy($new_row[id],`admin.plantations.destroy`,`.plantation_dt`)'>Delete</a>
                            </div>
                        </div> ";
    
                    return $btn;
    
                   })
                   ->rawColumns(['actions'])
                   ->make(true);
        }

        return view('admin.plantation.index');
    }

    public function create()
    {
        return view('admin.plantation.create', [
            'species' => Specie::all(),
            'locations' => Location::all(),
        ]);
    }

    public function store(PlantationRequest $request)
    {
        // $plantation = Plantation::where([
        //     'specie_id' => $request->specie_id,
        //     'location_id' => $request->location_id,
        // ])->first(); // check if exist

        // if($plantation)
        // {   
        //     return back()->with(['error' => 'Oops record already exist.']);
        // }

        Plantation::create($request->validated());

        return to_route('admin.plantations.index')->with(['success' => 'Plantation Added Successfully']);
    }
    
    public function show(Plantation $plantation)
    {
        return view('admin.plantation.show', [
            'plantation' => $plantation->load('specie.media', 'location')
        ]);
    }
    
    public function edit($id)
    {
        $plantation = Plantation::find($id)->first();
        return view('admin.plantation.edit', [
            'species' => Specie::all(),
            'locations' => Location::all(),
            'plantation' => $plantation
        ]);
    }

    public function update(PlantationRequest $request, Plantation $plantation)
    {
        $plantation->update($request->validated());

        return to_route('admin.plantations.index')->with(['success' => 'Plantation Added Successfully']);
    }

    public function destroy(Plantation $plantation)
    {
        $plantation->delete();

       return $this->res(['success' => 'Plantation Deleted Successfully']);
    }
}