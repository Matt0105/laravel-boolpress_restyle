@extends('layouts.admin')

@section('content')
    {{-- tengo questa pagina e reindirizzo, nel caso si volesse aggiungere una sezione di benvenuto --}}
    @php
        return view("admin.posts.index");
    @endphp
@endsection
