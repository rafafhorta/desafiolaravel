@extends('admin.layouts.app')
@section('content')
    @component('admin.components.show')
        @slot('title', $course->name)
        @slot('form')
            @include('admin.courses.form', ['create'=>false, 'show'=> true])
        @endslot
    @endcomponent
@endsection


@push('scripts')
    <script>
        $(".form-control").attr("disabled", true);
        $('select[value]').each(function () {
            $(this).val($(this).attr('value'));
        });
    </script>
@endpush