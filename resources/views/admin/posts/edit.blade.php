@extends('admin.layouts.app')

@section('title', "Alterando o Post {$post->title}")

@section('content')
<h1>Editar o Post <strong>{{ $post->title }}</strong></h1>

<form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">    
    @method('PUT')
    @include('admin.posts._partials.form')
</form>
@endsection