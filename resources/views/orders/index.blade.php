@extends('layouts.app')

@section('content')
    <div class="row">
        @if(session('message'))
            <div class="col-md-4 col-md-offset-4">
                <div class="alert alert-info" role="alert">
                    {{ session('message') }}
                </div>
            </div>
        @endif
        <h3 class="text-center">Заказы</h3>

        <div class="col-md-8 col-md-offset-2">
            <orders-component></orders-component>
        </div>
    </div>
@endsection