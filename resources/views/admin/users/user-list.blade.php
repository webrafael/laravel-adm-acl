@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header d-flex flex-row align-items-center justify-content-between">
            <h4 class="m-0">{{ __('Dashboard') }}</h4>
            <a class="btn btn-primary" href="{{ route('users.create') }}">Cadastrar novo</a>
        </div>

        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <table class="w-100">
                <thead>
                    <tr>
                        <th>NOME</th>
                        <th>LOGIN</th>
                        <th>CARGO</th>
                        <th>EDITAR</th>
                        <th>EXCLUIR</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users ?? [] as $user)
                        <tr>
                            <td>{{ $user?->name }}</td>
                            <td>{{ $user?->email }}</td>
                            <td>
                                @foreach ($user?->roles ?? [] as $role)
                                    {{ $role->name }}, 
                                @endforeach
                            </td>
                            <td>
                                <a class="btn btn-sm btn-warning text-white" href="{{ route("users.edit", $user?->uuid) }}">
                                    <span class="bi-pencil"></span> 
                                    Editar
                                </a>
                            </td>
                            <td>
                                <form action="{{ route('users.destroy', $user->uuid) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" type="submit">
                                        <span class="bi-trash"></span>
                                        Excluir
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection