@extends('welcome')

@section('content')
    @section('title')
        <h1 class="h3 mb-0 text-gray-800 font-weight-bolder">{{ $title ? $title : 'Ooppsss!' }}</h1>
    @endsection

    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h5 class="font-weight-bolder">Ubah Koding!</h5>
                <a href="/codex" class="btn btn-secondary btn-sm">Kembali</a>
            </div>
            <div class="card-body">
                <form action="{{ route('codex.update', ['codex' => $codex->slug]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="col-md-4">
                        <div class="mb-3">
                          <label for="type_uuid" class="form-label">Tipe Koding</label>
                          <select name="type_uuid" id="type_uuid" class="form-control selectType">
                            <option value="0" {{ old('type_uuid', $codex->type_uuid) == 0 ? 'selected' : '' }}>Pilih Tipe</option>
                            @foreach ($types as $type)
                               <option value="{{ $type->uuid }}" {{ old('type_uuid', $codex->type_uuid) == $type->uuid ? 'selected' : '' }}>{{ $type->type_koding }}</option>
                            @endforeach
                         </select>


                        </div>
                        <div class="md-12">
                            <label for="judul" class="form-label">Judul</label>
                            <input type="text" name="judul" id="judul" class="form-control" placeholder="Masukkan judul..." required autocomplete="false" autofocus value="{{ old('judul', $codex->judul) }}">
                        </div>
                    </div>
                    <div class="col-md-8 my-4">
                        <div class="md-12">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <textarea name="keterangan" class="my-editor form-control {{ $errors->has('keterangan') ? 'is-invalid' : '' }}" id="my-editor" cols="30" rows="10">{{ old('keterangan', $codex->keterangan) }}</textarea>
                            @if ($errors->has('keterangan'))
                            <div class="invalid-feedback">{{ $errors->first('keterangan') }}</div>
                            @endif
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
<script>
    CKEDITOR.replace('my-editor', {
        startupMode: 'source',
        removePlugins: 'elementspath,resize,link,unlink,pastefromword,scayt,image,flash,find,replace,selectall,form,checkbox,radiobutton,textfield,textarea,button,select,hiddenfield,underline,strikethrough,subscript,superscript,indent,outdent,blockquote,createDiv,stylescombo,format,font,fontSize,color,textTransform,justify,indentblock,bidi,about,maximize,showblocks,table',
        removeButtons: 'Bold,Italic,Underline,Strike,Subscript,Superscript,NumberedList,BulletedList,Outdent,Indent,Blockquote,JustifyLeft,JustifyCenter,JustifyRight,JustifyBlock,Undo,Redo,Scayt,Image,Flash,Table,HorizontalRule,SpecialChar,PageBreak,RemoveFormat,Paste,PasteText'
      });

      $('.selectType').select2();

</script>
@endpush
