<?php

namespace App\Http\Controllers;

use App\Models\Type;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'title' => 'Master Data Tipe Koding!'
        ];

        return view('./master/type/get', $data);
    }

    public function getServersideType()
    {
        $data = Type::select(['uuid', 'slug', 'type_koding','colors', 'created_at']);

        return DataTables::of($data)
            ->addIndexColumn()
            ->editColumn('created_at', function ($row) {
                return Carbon::parse($row->created_at)->format('Y-m-d H:i:s');
            })
            ->addColumn('DT_RowIndex', function ($row) {
                return $row->uuid;
            })
            ->addColumn('aksi', function ($row) {
                $btn = '<a href="' . route('type.edit', $row->slug) . '" class="btn btn-sm btn-primary mr-1"><i class="fas fa-edit"></i> Edit</a>';
                $btn .= '<form action="' . route('type.destroy', $row->slug) . '" method="post" class="d-inline-block">
                    ' . method_field('DELETE') . '
                    ' . csrf_field() . '
                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm(\'Apakah Anda yakin ingin menghapus data ini?\')"><i class="fas fa-trash"></i> Delete</button>
                </form>';

                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'title' => 'Master Data Tipe Koding!',
        ];

        return view('./master/type/add', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'type_koding' => 'required|unique:types',
        ]);

        if ($validator->fails()) {
            Alert::error('Error', implode('<br>', $validator->errors()->all()));
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $type = new Type;
        $type->uuid = Str::uuid();
        $type->type_koding = $request->input('type_koding');
        $type->slug = Str::slug($request->input('type_koding'));
        $type->colors = $request->input('colors');

        try {
            $type->save();
            Alert::success('Success', 'Mantap');
            $redirect = redirect()->route('type.index');
        } catch (\Exception $e) {
            Alert::error('Error', 'Ooppsss: ' . $e->getMessage());
            $redirect = redirect()->back();
        }

        return $redirect;
    }



    /**
     * Display the specified resource.
     */

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Type $type)
    {
        $data = [
            'title' => 'Master Data Tipe Koding!',
            'type' => $type
        ];

        return view('./master/type/edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Type $type)
    {
        $validator = Validator::make($request->all(), [
            'type_koding' => [$this->isUpdate(), 'string'],
            'colors' => [$this->isUpdate(), 'string'],
        ]);

        if ($validator->fails()) {
            Alert::error('Error', implode('<br>', $validator->errors()->all()));
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $type->type_koding = $request->input('type_koding');
        $type->slug = Str::slug($request->input('type_koding'));
        $type->colors = $request->input('colors');

        try {
            $type->save();
            Alert::success('Success', 'Mantap');
            $redirect = redirect()->route('type.index');
        } catch (\Exception $e) {
            Alert::error('Error', 'Ooppsss: ' . $e->getMessage());
            $redirect = redirect()->back();
        }

        return $redirect;
    }

    public function isUpdate()
    {
        return request()->isMethod('POST') ? 'required' : 'sometimes';
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Type $type)
    {
        try {
            $type->delete();
            Alert::success('Success', 'Data berhasil dihapus');
        } catch (\Exception $e) {
            Alert::error('Error', 'Ooppsss: ' . $e->getMessage());
        }

        return redirect()->route('type.index');
    }


}
