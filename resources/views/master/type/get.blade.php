@extends('welcome')

@section('content')
    @section('title')
        <h1 class="h3 mb-0 text-gray-800 font-weight-bolder">{{ $title ? $title : 'Something Wrong!' }}</h1>
    @endsection

    <div class="col-md-12">
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Master Tipe Koding</h6>
                <a href="type/create" class="btn btn-primary btn-sm">Tambah</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered dataTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Type Koding</th>
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
            ajax: '{{ route('getServersideType') }}',
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex'},
                { data: 'type_koding', name: 'type_koding', render: function(data, type, row) {
                    return '<span class="badge" style="background-color: ' + row.colors + '; color: white;">' + data + '</span>';
                } },
                { data: 'created_at', name: 'created_at' },
                { data: 'aksi', name: 'aksi', orderable: false, searchable: false }
            ]
        });
    });

</script>
@endpush
