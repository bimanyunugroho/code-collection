<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Type;
use App\Models\Codex;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\UpdateCodexRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CodexController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'title'     => 'Koleksi Koding',
            'codexes'   => Codex::latest()->get()
        ];

        return view('content.codex.get', $data);
    }

    public function getServersideCodex()
    {
        $data = Codex::leftJoin('types', 'types.uuid', '=', 'codexes.type_uuid')
        ->select('codexes.uuid', 'codexes.type_uuid', 'types.uuid', 'types.type_koding', 'types.colors', 'codexes.judul', 'codexes.slug', 'codexes.keterangan', 'codexes.created_at');

        return DataTables::of($data)
            ->addIndexColumn()
            ->editColumn('created_at', function ($row) {
                return Carbon::parse($row->created_at)->format('Y-m-d H:i:s');
            })
            ->addColumn('DT_RowIndex', function ($row) {
                return $row->uuid;
            })
            ->addColumn('aksi', function ($row) {
                $user_id = auth()->user()->id;
                $btn = '<a href="' . route('codex.show', $row->slug) . '" class="btn btn-sm btn-info mr-1"><i class="fas fa-eye"></i> View</a>';
                if ($row->types->user_id == $user_id) {
                    $btn .= '<a href="' . route('codex.edit', $row->slug) . '" class="btn btn-sm btn-primary mr-1"><i class="fas fa-edit"></i> Edit</a>';
                    $btn .= '<form action="' . route('codex.destroy', $row->slug) . '" method="post" class="d-inline-block">
                        ' . method_field('DELETE') . '
                        ' . csrf_field() . '
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm(\'Apakah Anda yakin ingin menghapus data ini?\')"><i class="fas fa-trash"></i> Delete</button>
                    </form>';
                }

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
        $user_id = auth()->user()->id;

        $data = [
            'title' => 'Koleksi Koding',
            'types' => Type::where('user_id', $user_id)->latest()->get()
        ];

        return view('content.codex.add', $data);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'type_uuid' => 'required',
            'judul' => 'required|unique:codexes',
            'keterangan' => 'required'
        ]);

        if ($validator->fails()) {
            Alert::error('Error', implode('<br>', $validator->errors()->all()));
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $codex = new Codex;
        $codex->uuid = Str::uuid();
        $codex->type_uuid = $request->input('type_uuid');
        $codex->judul = $request->input('judul');
        $codex->slug = Str::slug($request->input('judul'));
        $codex->keterangan = $request->input('keterangan');

        try {
            $codex->save();
            Alert::success('Success', 'Mantap');
            $redirect = redirect()->route('codex.index');
        } catch (\Exception $e) {
            Alert::error('Error', 'Ooppsss: ' . $e->getMessage());
            $redirect = redirect()->back();
        }

        return $redirect;
    }

    /**
     * Display the specified resource.
     */
    public function show(Codex $codex)
    {
        $query = Codex::join('types', 'codexes.type_uuid', '=', 'types.uuid')
                    ->select('codexes.*', 'types.type_koding')
                    ->where('codexes.uuid', $codex->uuid)
                    ->first();

        $data = [
            'title'     => 'Koleksi Koding',
            'codex'     => $query
        ];

        return view('content.codex.show', $data);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Codex $codex)
    {
        $user_id = auth()->user()->id;

        $data = [
            'title'     => 'Koleksi Koding',
            'types'     => Type::where('user_id', $user_id)->latest()->get(),
            'codex'     => $codex
        ];

        return view('content.codex.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Codex $codex)
    {
        $validator = Validator::make($request->all(), [
            'type_uuid' => [$this->isUpdate()],
            'judul' => [$this->isUpdate()],
            'keterangan' => [$this->isUpdate()]
        ]);

        if ($validator->fails()) {
            Alert::error('Error', implode('<br>', $validator->errors()->all()));
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $codex->type_uuid = $request->input('type_uuid');
        $codex->judul = $request->input('judul');
        $codex->slug = Str::slug($request->input('judul'));
        $codex->keterangan = $request->input('keterangan');

        try {
            $codex->save();
            Alert::success('Success', 'Mantap');
            $redirect = redirect()->route('codex.index');
        } catch (\Exception $e) {
            Alert::error('Error', 'Ooppsss: ' . $e->getMessage());
            $redirect = redirect()->back();
        }

        return $redirect;
    }

    /**
     * Mengembalikan nilai 'required' jika permintaan HTTP saat ini adalah metode POST, dan 'sometimes' jika bukan POST.
     *
     * @return string
     */
    public function isUpdate(): string {
        return request()->isMethod('POST') ? 'required' : 'sometimes';
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Codex $codex)
    {
        try {
            $codex->delete();
            Alert::success('Success', 'Data berhasil dihapus');
        } catch (\Exception $e) {
            Alert::error('Error', 'Ooppsss: ' . $e->getMessage());
        }

        return redirect()->route('codex.index');
    }
}
