@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header d-flex flex-row align-items-center justify-content-between">
                <h4 class="m-0">{{ __('Dashboard') }}</h4>
                <a class="btn btn-warning text-white" href="{{ route('roles.index') }}">Voltar</a>
            </div>

            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <form action="{{ route('roles.store') }}" method="post">
                    @csrf
                    @include('admin.roles._partials.form')
                </form>
            </div>
        </div>
    </div>
@endsection
