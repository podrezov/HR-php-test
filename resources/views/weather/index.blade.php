@extends('layouts.app')

@section('content')
    <h3 class="text-center">🌡️ Текущая погода {{ $weather['temp'] }}℃</h3>
@endsection