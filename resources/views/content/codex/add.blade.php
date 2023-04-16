@extends('welcome')

@section('content')
    @section('title')
        <h1 class="h3 mb-0 text-gray-800 font-weight-bolder">{{ $title ? $title : 'Ooppsss!' }}</h1>
    @endsection

    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h5 class="font-weight-bolder">Tambah Tipe Koding!</h5>
                <a href="/codex" class="btn btn-secondary btn-sm">Kembali</a>
            </div>
            <div class="card-body">
                <form action="{{ route('codex.store') }}" method="POST">
                    @csrf
                    <div class="col-md-4">
                        <div class="mb-3">
                          <label for="type_uuid" class="form-label">Tipe Koding</label>
                          <select name="type_uuid" id="type_uuid" class="form-control typeSelect">
                            <option value="0" selected>Pilih Tipe</option>
                            @foreach ($types as $type)
                                <option value="{{ $type->uuid }}">{{ $type->type_koding }}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="md-12">
                            <label for="judul" class="form-label">Judul</label>
                            <input type="text" name="judul" id="judul" class="form-control" placeholder="Masukkan judul..." required autocomplete="false" autofocus>
                        </div>
                    </div>
                    <div class="col-md-8 my-4">
                        <div class="md-12">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <textarea name="keterangan" class="my-editor form-control" id="my-editor" cols="30" rows="10"></textarea>
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

      $('.typeSelect').select2();

</script>
@endpush
