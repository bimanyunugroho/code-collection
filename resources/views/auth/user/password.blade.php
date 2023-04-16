@extends('welcome')

@section('content')
    @section('title')
        <h1 class="h3 mb-0 text-gray-800 font-weight-bolder">{{ $title ? $title : 'Ooppsss!' }}</h1>
    @endsection

    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h5 class="font-weight-bolder">{{ $desc }} - Password Baru</h5>
                <a href="/home" class="btn btn-secondary btn-sm">Kembali</a>
            </div>
            <div class="card-body">
                <div class="col-md-12">
                    <form action="{{ route('setting.update', $settings->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-4 my-2">
                                <div class="input-group">
                                    <input type="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password" name="password" required autocomplete="false" autofocus>
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-sm btn-outline-secondary toggle-password" data-input="#exampleInputPassword"><i class="fa fa-eye"></i></button>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 my-2">
                                <div class="input-group">
                                    <input type="password" class="form-control form-control-user" id="exampleRepeatPassword" placeholder="Repeat Password" name="password_confirmation" required autocomplete="false">
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-sm btn-outline-secondary toggle-password" data-input="#exampleRepeatPassword"><i class="fa fa-eye"></i></button>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 my-2">
                                <button type="submit" class="btn btn-success">Ubah Password</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('scripts')
<script>
    $(document).ready(function() {
        $('input[name="password_confirmation"]').on('input', function() {
            var password = $('input[name="password"]').val();
            var password_confirmation = $('input[name="password_confirmation"]').val();

            if (password === password_confirmation) {
                $('input[name="password_confirmation"]').removeClass('is-invalid').addClass('is-valid');
            } else {
                $('input[name="password_confirmation"]').removeClass('is-valid').addClass('is-invalid');
            }
        });

        $('.toggle-password').on('click', function() {
            var input = $($(this).attr('data-input'));
            var icon = $(this).find('i');

            if (input.attr('type') === 'password') {
                input.attr('type', 'text');
                icon.removeClass('fa-eye').addClass('fa-eye-slash');
            } else {
                input.attr('type', 'password');
                icon.removeClass('fa-eye-slash').addClass('fa-eye');
            }
        });
    });
</script>
@endpush
