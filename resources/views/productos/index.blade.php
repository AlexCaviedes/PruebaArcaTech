@extends('layouts.app')

@section('title') Menú Principal @endsection
@section('title_content') Menú Principal @endsection

@section('content')
<div class="section-body">
    <div class="container-fluid">
        <h4>Menú principal </h4>
    </div>
</div>

    @include('layouts.menu')

@endsection