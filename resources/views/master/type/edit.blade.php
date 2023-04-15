@extends('welcome')

@section('content')
    @section('title')
        <h1 class="h3 mb-0 text-gray-800 font-weight-bolder">{{ $title ? $title : 'Ooppsss!' }}</h1>
    @endsection

    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h5 class="font-weight-bolder">Ubah Tipe Koding!</h5>
                <a href="/type" class="btn btn-secondary btn-sm">Kembali</a>
            </div>
            <div class="card-body">
                <div class="col-md-4">
                    <form action="{{ route('type.update', ['type' => $type->slug]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                          <label for="type_koding" class="form-label">Tipe Koding</label>
                          <input type="text" class="form-control" id="type_koding" name="type_koding" placeholder="Masukkan Nilai Type Koding..." required autocomplete="false" value="{{ $type->type_koding }}">
                          <div class="mb-3">
                            <label for="colors" class="form-label">Warna</label>
                            <input type="color" class="form-control" id="colors" name="colors" required value="{{ old('colors', $type->colors) }}">
                          </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
