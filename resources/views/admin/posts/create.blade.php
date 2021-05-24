@extends('admin.layouts.app')

@section('title', 'Criando um Post')
    
@section('content')
<h1>Cadastrar novo post</h1>

<form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
    @include('admin.posts._partials.form')
</form>
@endsection