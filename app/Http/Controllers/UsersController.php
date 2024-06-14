<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use Yajra\DataTables\Facades\DataTables;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('users-view');
    }

    public function listUsers()
    {
        $users = User::orderBy('id','DESC');
        return DataTables::of($users)->addIndexColumn()
        ->addColumn('action', function($row){
            $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
            return $actionBtn;
        })
        ->rawColumns(['action'])
        ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create-user');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $create = User::create([
            'name' => $request->name,
            'password' => '$2y$10$4yOOm5Ag87w8YofdnHJq0.sPg6Q2UEODp8hqSr8Lhp4Fs7PmF3ssy', // password
            'email' => $request->email,
            'emp_code' => Str::random(5),
            'join_date' => $request->join_date,
            'position' => $request->position,
            'emp_status' => $request->emp_status
        ]);

        if ($request->file('file')) {
            $file = $request->file('file');
            $filename = time().'_'.$file->getClientOriginalName();
            $request->file->storeAs('uploads/', $filename, 'public');
            $create->update([
                'photo' => '/storage/uploads/'.$filename
            ]);
        }

        return response()->json([
            'status' => 200,
            'data' => new UserResource($create)
        ], 201);
    }
}
