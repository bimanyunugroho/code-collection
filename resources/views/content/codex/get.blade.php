@extends('welcome')

@section('content')
    @section('title')
        <h1 class="h3 mb-0 text-gray-800 font-weight-bolder">{{ $title ? $title : 'Something Wrong!' }}</h1>
    @endsection

    <div class="col-md-12">
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Koleksi Kodingku</h6>
                <a href="codex/create" class="btn btn-primary btn-sm">Tambah</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered dataTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Type Koding</th>
                                <th>Judul</th>
                                <th>Created At</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    $(function() {
        $('.dataTable').DataTable({
            processing: true,
            serverSide: true,
            search: true,
            ajax: '{{ route('getServersideCodex') }}',
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex'},
                { data: 'type_koding', name: 'types.type_koding', render: function(data, type, row) {
                    return '<span class="badge" style="background-color: ' + row.colors + '; color: white;">' + data + '</span>';
                } },
                { data: 'judul', name: 'judul' },
                { data: 'created_at', name: 'created_at' },
                { data: 'aksi', name: 'aksi', orderable: false, searchable: false }
            ]
        });
    });
</script>
@endpush
