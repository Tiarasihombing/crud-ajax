<?php

namespace App\Http\Controllers;

use App\Models\level_kelas;
use Illuminate\Http\Request;
use DataTables;

class level_kelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $data = level_kelas::latest()->get();
              return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row) {
        
              $btn = '<a href="javascript:void(0)" id="editlevel" data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editlevel_kelas">Edit</a>';
              $btn = $btn.' <a href="javascript:void(0)" id="hapuslevel" data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deletelevel_kelas">Delete</a>';
        
                return $btn;
          })
                ->rawColumns(['action'])
                ->make(true);
          }else{
                return view('level_kelas');
            }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $data = level_kelas::latest()->get();
        return DataTables::of($data)
          ->addIndexColumn()
          ->addColumn('action', function($row) {
  
        $btn = '<a href="javascript:void(0)" id="editlevel" data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editlevel_kelas">Edit</a>';
        $btn = $btn.' <a href="javascript:void(0)" id="hapuslevel" data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deletelevel_kelas">Delete</a>';
  
          return $btn;
    })
          ->rawColumns(['action'])
          ->make(true);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        level_kelas::updateOrCreate(
            ['id' => $request->id_levelKelas],
              [ 'name' => $request->name,]);  
          return response()->json(['success'=>'level_kelas saved successfully.' ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $level_kelas = level_kelas::find($id);
        return response()->json($level_kelas);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        level_kelas::find($id)->delete();
        return response()->json([
            'success'=> true,
            'message'=>'level_kelas saved successfully.'
        ]);
    }
}
