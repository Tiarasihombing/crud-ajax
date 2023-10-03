<?php

namespace App\Http\Controllers;

use App\Models\barang;
use Illuminate\Http\Request;
use DataTables;

class barangController extends Controller
{
    /**
     * Display a listing of the resource.
     * menampilkan data
     */
    public function index(Request $request)
    {
        // dd('aku index');
        if($request->ajax()){
            $data = barang::latest()->get();
            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row) {

                $btn = '<a href="javascript:void(0)" id="editBarang" data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-warning btn-sm editbarang">Edit</a>';
                $btn = $btn.' <a href="javascript:void(0)" id="hapusBarang" data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deletebarang">Delete</a>';

                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }else{
            return view('barang');
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
        barang::updateOrCreate(
            ['id' => $request->barang_id],
            [
                'name_barang' => $request->name_barang,
                'jumlah_barang' => $request->jumlah_barang,
            ]);
        return response()->json(['success'=>'barang saved successfully.']);
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
        $barang = barang::find($id);
        return response()->json($barang);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * menghapus data
     */
    public function destroy($id)
    {
        barang::find($id)->delete();
        return response()->json([
            'success'=>true,
            'message'=>'barang saved successfully.'
        ]);
    }
}
