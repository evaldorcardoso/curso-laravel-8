@extends('admin.layouts.app')

@section('title', 'Listagem dos Posts')
    
@section('content')

<h1 class="text-center text-3xl uppercase font-black my-4">Listagem dos Posts</h1>

<div class="grid">
    <a href="{{ route('posts.create') }}" class="text-indigo-600 hover:text-indigo-900">Criar Novo Post</a>
</div>
@if (session('message'))
    <div class="flex justify-center items-center m-1 font-medium py-1 px-2 bg-white rounded-md text-green-700 bg-green-100 border border-green-300 ">
        {{ session('message') }}
    </div>
@endif

<form action="{{ route('posts.search') }}" method="post" class="bg-white">
    @csrf
    <input type="text" name="search" placeholder="Filtrar:" class="flex-1 appearance-none rounded shadow p-3 text-grey-dark mr-2 focus:outline-none">
    <button type="submit" class="uppercase p-3 rounded bg-blue-500 text-blue-50 max-w-max shadow-sm hover:shadow-lg">Filtrar</button>
</form>

<div class="flex flex-col">
    <div class="-my-2 overflow-x-auto sm:-mx-12 lg:-mx-12">
      <div class="py-2 align-middle inline-block min-w-full sm:px-12 lg:px-12">
        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">

        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    ID
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Imagem
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Nome
                </th>
                <th scope="col" class="relative px-6 py-3">
                    <span class="sr-only">Edit</span>
                </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($posts as $post)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            #{{ $post->id }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10">
                                    <img class="h-10 w-10 rounded-full" src="{{ url("storage/{$post->image}") }}" alt="{{ $post->title }}">
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $post->title }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <a href="{{ route('posts.show', $post->id) }}" class="text-indigo-600 hover:text-indigo-900">Ver</a>
                            <a href="{{ route('posts.edit', $post->id) }}" class="text-indigo-600 hover:text-indigo-900">Editar</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        </div>
      </div>
    </div>
</div>

<div class="my-4">
    @if (isset($filters))
        {{ $posts->appends($filters)->links() }}
    @else
        {{ $posts->links() }}
    @endif
</div>

@endsection