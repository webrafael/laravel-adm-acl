@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header d-flex flex-row align-items-center justify-content-between">
            <h4 class="m-0">{{ __('Dashboard') }}</h4>

            <a class="btn btn-primary" href="{{ route('roles.create') }}">Cadastrar novo</a>
        </div>

        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <table class="w-100">
                <thead>
                    <th>NAME</th>
                    <th>DESCRIPTION</th>
                    <th>Ativo</th>
                    <th>Editar</th>
                    <th>Excluir</th>
                </thead>
                <tbody>
                    @foreach ($roles as $role)    
                        <tr>
                            <td>{{ $role->name }}</td>
                            <td>{{ $role->details }}</td>
                            <td>{{ ($role->active == 'yes') ? 'Sim' : 'Não' }}</td>
                            <td>
                                <a class="btn btn-sm btn-warning text-white" href="{{ route("roles.edit", $role->uuid) }}">
                                    <span class="bi-pencil"></span>
                                    Editar
                                </a>
                            </td>
                            <td>
                                <form action="{{ route('roles.destroy', $role->uuid) }}" method="post">
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