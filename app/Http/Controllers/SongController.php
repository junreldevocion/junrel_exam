<?php

namespace App\Http\Controllers;

use App\Song;
use Illuminate\Http\Request;
use DataTables;

class SongController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return DataTables::of(Song::query())->make(true);

        $data = Song::select('*');
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
     
                           $btn1 = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">Edit</a>';
                           $btn2 = '<a href="javascript:void(0)" class="edit btn btn-danger btn-sm">Delete</a>';
       
                            return $btn1." ".$btn2;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'artist' => 'required',
            'lyrics' => 'required',
        ]);

        Song::create($request->all());

        return response()->json(
            [
            'success' => true,
            'message' => 'Success'
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $song = Song::find($id);
        $product->update($request->all());
        return $song;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $song = Song::find($id);
        $product->update($request->all());
        return $song;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
