@php
    //dd($x);

@endphp

@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                @include('forms.create-project')
            </div>
        </div>
    </div>

@endsection