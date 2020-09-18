<head>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
</head>
<div class="row">
    <div class="form-group col-12">
        <label for="name" class="required">Nome </label>
        <input type="text" name="name" id="name" required class="form-control" autofocus value="{{ old('name', $course->name )}}">
    </div>
</div>
<div class="row">
    <div class="col-sm-12 form-group">
        <label for="text" class="required mt-2">Descrição</label>
        @if($create ?? true)
            <textarea class="summernote form-control" rows="10" id="summernote" name="text" required>{{ old('text',$course->text) }}</textarea>
        @else
            @if($show ?? true)
                <p class="text-justify"> {!! $course->text !!} </p>
            @else
                <textarea class="summernote form-control" rows="10" id="summernote" name="text" required>{{ old('text',$course->text) }}</textarea>
            @endif
        @endif
    </div>
</div>
<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <label for="imglink" class="required">Imagem </label>
            <div class="custom-file">
                @if($create ?? true)
                    <input type="file" name="imglink" class="form-control-file" id="imglink" lang="pt-br" accept="image/*" value="{{ old('imglink', $course->imglink) }}" required>
                @else
                    @if($show ?? true)
                        <img class="img-responsive" width="300" height="300" src="{{ URL('storage/img/course/'. $course->imglink) }}" alt="Imagem do curso {{ $course->name }}" />
                    @else
                        <input type="file" name="imglink" class="form-control-file" id="imglink" lang="pt-br" accept="image/*" value="{{ old('imglink', $course->imglink) }}">
                    @endif
                @endif
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="form-group col-12">
        @if($create ?? true)
            <label for="videolink" class="required">Link do vídeo </label>
            <input type="text" name="videolink" id="videolink" required class="form-control" autofocus value="{{ old('videolink', $course->videolink )}}">
        @else
            @if($show ?? true)
                <iframe width="420" name="videolink" height="315" src="{{ old('videolink', $course->videolink )}}"></iframe>
            @else
                <label for="videolink" class="required">Link do vídeo </label>
                <input type="text" name="videolink" id="videolink" class="form-control" autofocus value="{{ old('videolink', $course->videolink )}}">
            @endif
        @endif
    </div>
</div>
<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <label for="category_id" class="required">Categoria</label>
            <select name="category_id" class="form-control" id="category_id" required value="{{ old('category_id',$course->category_id) }}">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        $(function(){
            $('.select2').select2();
        })
        $('select[value]').each(function(){
            $(this).val($(this).attr('value'));
        })
    </script>

    <script>
        $('#summernote').summernote({
        placeholder: 'Descrição do curso',
        tabsize: 2,
        height: 120,
        toolbar: [
        ['style', ['style']],
        ['font', ['bold', 'underline', 'clear']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['table', ['table']],
        ['view', ['fullscreen', 'codeview', 'help']]
        ]});
    </script>
@endpush