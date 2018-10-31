@extends('layouts.usersApp')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Ingresar documento sin puntos</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action="POST">
                        <input type="number" placeholder="Ej: 38155143" class="docInput" required>
                        <button type="submit" class="submitDoc">Enviar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
