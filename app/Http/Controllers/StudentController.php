<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Throwable;
use Yajra\DataTables\Facades\DataTables;

class StudentController extends Controller
{
      /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Student::orderBy('name', 'asc');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('photo_profile', function ($row) {
                    if ($row->photo == null) {
                        $photo = '<img alt="image" src="'. $row->avatar_url.'" class="rounded-circle" width="30">';
                    }
                    return $photo;
                })
                ->addColumn('action', function($row){
    
                        $btn = '<a href="' . route('student.edit', $row->id) . '" class="btn btn-warning">Edit</a>
                                <a href="' . route('student.show', $row->id) . '" class="btn btn-success">Detail</a>';
    
                        return $btn;
                })
                ->filter(function ($instance) use ($request) {
                    if ($request->get('status')) {
                        $instance->where('major', $request->get('status'));
                    }

                    if (!empty($request->get('search'))) {
                        $instance->where('major', $request->get('status'));
                    }
                })
                ->rawColumns(['action', 'photo_profile'])
                ->make(true);
        }
        return view('student.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
