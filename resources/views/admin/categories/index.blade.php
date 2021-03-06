@extends('admin.layouts.app')
@section('content')
    @component('admin.components.table')
        @slot('titulo', 'Categoria')
        @slot('create', route('categories.create'))
        @slot('head')
            <th>Nome</th>
            <th class="text-right">Ações</th>     
        @endslot
        @slot('body')
            @foreach ($categories as $category)
                <tr>
                    <td>{{ $category->name }}</td>
                    <td class="options text-right">
                        <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-primary"><i class="fas fa-pen"></i></a> 
                        <a href="{{ route('categories.show', $category->id) }}" class="btn btn-dark"><i class="nav-icon fas fa-search"></i></a> 
                        <form method="POST" class="form-delete" action="{{ route('categories.destroy',$category->id)}}">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                        </form>    
                    </td>
                </tr>
            @endforeach
        @endslot
    @endcomponent
@endsection

@push('scripts')
    <script src="{{ asset('js/components/dataTable.js') }}"></script>
    <script src="{{ asset('js/components/sweetAlert.js') }}"></script>
@endpush