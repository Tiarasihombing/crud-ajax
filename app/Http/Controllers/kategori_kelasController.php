<?php

namespace App\Http\Controllers;

use App\Models\KelasKategori;
use Illuminate\Http\Request;
use DataTables;

class kategori_kelasController extends Controller
{
    /**
     * Display a listing of the resource.
     * menampilkan data
     */
    public function index(Request $request)
    {
         
      if($request->ajax()){
        $data = KelasKategori::latest()->get();
          return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row) {
    
          $btn = '<a href="javascript:void(0)" id="edit" data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editkategori_kelas">Edit</a>';
          $btn = $btn.' <a href="javascript:void(0)" id="hapus" data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deletekategori_kelas">Delete</a>';
    
            return $btn;
      })
            ->rawColumns(['action'])
            ->make(true);
      }else{
            return view('kategori_kelas');
        }
    }

    /**
     * Show the form for creating a new resource.
     * membuat data
     */
    public function create(Request $request)
    {  
        $data = KelasKategori::latest()->get();
          return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row) {

          $btn = '<a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editkategori_kelas">Edit</a>';
          $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deletekategori_kelas">Delete</a>';

            return $btn;
      })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * Store a newly created resource in storage.
     * pendeklarasian fungsi yang dimana fungsi store ini akan menerima satu parameter
     */
    public function store(Request $request)
    {
        KelasKategori::updateOrCreate(
          ['id' => $request->kategori_kelas_id],
            [ 'name' => $request->name, 
              'description' => $request->description
            ]);  
        return response()->json(['success'=>'kategori_kelas saved successfully.' ]);
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
     * edit data
     */
    public function edit($id)
    {
         $KelasKategori = KelasKategori::find($id);
         return response()->json($KelasKategori);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
    
    }

    /**
     * Remove the specified resource from storage.
     * menghapus data
     */
    public function destroy($id)
    {
        KelasKategori::find($id)->delete();
        return response()->json([
            'success'=> true,
            'message'=>'kategori_kelas saved successfully.'
        ]);
    }
}
