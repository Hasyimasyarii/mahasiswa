<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Throwable;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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
                    }else{
                        $photo = '<img alt="image" src="'. $row->photo.'" class="rounded-circle" width="30">';
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
                        $instance->where(function($w) use($request){
                            $search = $request->get('search');
                            $w->orWhere('name', 'LIKE', "%$search%");
                        });
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
        return view('student.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'      => 'required|unique:students,name',
            'nim'       => 'required|unique:students,nim',
            'age'       => 'required',
            'major'     => 'required',
            'address'   => 'required',
        ]);

        try {
            
            DB::beginTransaction();

            if ($request->file('image') == null) {
                $student = Student::create([
                    'name'      => $validated['name'],
                    'nim'       => $validated['nim'],
                    'age'       => $validated['age'],
                    'major'     => $validated['major'],
                    'address'   => $validated['address'],
                ]);
            }else {
                $image = $request->file('image');
                $image->storeAs('public/students', $image->hashName());

                $student = Student::create([
                    'name'      => $validated['name'],
                    'nim'       => $validated['nim'],
                    'age'       => $validated['age'],
                    'major'     => $validated['major'],
                    'address'   => $validated['address'],
                    'photo'     => $image->hashName()
                ]);
            }
           

            DB::commit();

            $notification = array(
                'message'   => 'Berhasil tambah mahasiswa dengan nama '.$student->name,
                'title'     => 'Mahasiswa'
            );
            
            return redirect()->route('student.show', $student->id)->with($notification);

        } catch (\Throwable $e) {
            return redirect()->back()->with(['error' => 'Tambah data gagal! ' . $e->getMessage()]);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $student = Student::find($id);

        return view('student.show', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $student = Student::find($id);

        return view('student.edit', compact('student'));
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
        $validated = $request->validate([
            'name'      => 'required',
            'nim'       => 'required',
            'age'       => 'required',
            'major'     => 'required',
            'address'   => 'required',
        ]);

        try {
            
            DB::beginTransaction();
            $student = Student::find($id);

            if ($request->file('image') == null) {
                $student->update([
                    'name'      => $validated['name'],
                    'nim'       => $validated['nim'],
                    'age'       => $validated['age'],
                    'major'     => $validated['major'],
                    'address'   => $validated['address'],
                ]);
            }else {
                if ($student->photo != null) {
                    Storage::delete('public/students/' . basename($student->photo));
                }
                $image = $request->file('image');
                $image->storeAs('public/students', $image->hashName());

                $student->update([
                    'name'      => $validated['name'],
                    'nim'       => $validated['nim'],
                    'age'       => $validated['age'],
                    'major'     => $validated['major'],
                    'address'   => $validated['address'],
                    'photo'     => $image->hashName()
                ]);
            }
           

            DB::commit();

            $notification = array(
                'message'   => 'Berhasil tambah mahasiswa dengan nama '.$student->name,
                'title'     => 'Mahasiswa'
            );
            
            return redirect()->route('student.show', $student->id)->with($notification);

        } catch (\Throwable $e) {
            return redirect()->back()->with(['error' => 'Tambah data gagal! ' . $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $student =  Student::find($id);
            if ($student->photo != null) {
                Storage::delete('public/students/' . basename($student->photo));
            }
            $student->delete();

            return response()->json(['status' => 'success']);
        } catch (Throwable $e) {

            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
