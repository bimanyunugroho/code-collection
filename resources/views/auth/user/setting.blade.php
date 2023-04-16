@extends('welcome')

@section('content')
    @section('title')
        <h1 class="h3 mb-0 text-gray-800 font-weight-bolder">{{ $title ? $title : 'Ooppsss!' }}</h1>
    @endsection

    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h5 class="font-weight-bolder">{{ $desc }}</h5>
                <a href="/home" class="btn btn-secondary btn-sm">Kembali</a>
            </div>
            <div class="card-body">
                <div class="col-md-12">
                    <form action="{{ route('profile.update', $users->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="col-md mb-3">
                                    <label for="first_name">Nama Depan</label>
                                    <input type="text" class="form-control first_name" value="{{ old('first_name', $users->first_name) }}" name="first_name" id="last_name" placeholder="Input nama depan anda..." autofocus autocomplete="false">
                                </div>
                                <div class="col-md mb-3">
                                    <label for="last_name">Nama Belakang</label>
                                    <input type="text" class="form-control last_name" value="{{ old('last_name', $users->last_name) }}" name="last_name" id="last_name" placeholder="Input nama belakang anda..." autocomplete="false">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="col-md mb-3">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control email" value="{{ old('email', $users->email) }}" name="email" id="email" placeholder="Input email anda..." autocomplete="false">
                                </div>
                                <div class="col-md mb-3">
                                    <label for="username">Username</label>
                                    <input type="text" class="form-control username" value="{{ old('username', $users->username) }}" name="username" id="username" placeholder="Username by generate..." autocomplete="false" readonly>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="col-md mb-3">
                                    <button type="submit" class="btn btn-success">Ubah Profile</button>
                                </div>
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
        $('.first_name, .last_name').on('input', function() {
            var first_name = $('.first_name').val();
            var last_name = $('.last_name').val();
            var full_name = first_name + '_' + last_name;

            var username = full_name.replace(/\s+/g, '').toLowerCase();
            console.log(username);
            $('.username').val(username);
        });

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
