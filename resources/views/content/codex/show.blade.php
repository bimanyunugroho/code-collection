@extends('welcome')

@section('content')
    @section('title')
        <h1 class="h3 mb-0 text-gray-800 font-weight-bolder">{{ $title ? $title : 'Something Wrong!' }}</h1>
    @endsection

    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('codex.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
            <div class="card-body">
              <h3 class="card-title">{{ $codex->judul }}</h3>
              <p class="card-text"><span class="badge badge-warning">{{ $codex->type_koding }}</span></p>
                <div class="position-relative">
                    <pre><code id="my-code" class="language-{{ $codex->type_koding }}">{{ $codex->keterangan }}</code></pre>
                </div>
                <button onclick="copyCode('my-code')" class="btn btn-primary">Copy</button>
            </div>
        </div>
    </div>

@endsection
@push('scripts')
    <script>
        var clipboard = new ClipboardJS('.btn');

        function copyCode(elementId) {
            var element = document.getElementById(elementId);
            var range = document.createRange();
            range.selectNode(element);
            window.getSelection().removeAllRanges();
            window.getSelection().addRange(range);
            document.execCommand("copy");
            window.getSelection().removeAllRanges();
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: 'Kode berhasil dicopy!',
            });
        }
    </script>
@endpush
