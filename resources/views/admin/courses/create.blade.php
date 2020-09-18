@extends('admin.layouts.app')
@section('content')
    @component('admin.components.create')
        @slot('title', 'Cadastrar um curso')
        @slot('url', route('courses.store'))
        @slot('form')
            @include('admin.courses.form', ['create'=> true])
        @endslot
    @endcomponent
@endsection