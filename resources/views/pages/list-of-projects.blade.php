@php
//dd($x);

@endphp

@extends('layouts.master')

@section('content')

    <table class="table table-hover">
        <thead>
        <tr>
            <th scope="col">

                <a href="/projects/1/id">#</a>

            </th>
            <th scope="col">Name</th>
            <th scope="col">Description</th>
            <th scope="col">
                <a href="/projects/1/status">Status</a>
            </th>
            <th scope="col">Contact Persons</th>
        </tr>
        </thead>
        <tbody>

        @foreach($projects -> items() as $project)
            <tr data-id="{{$project -> id}}">
                <th scope="row">{{$project -> id}}</th>
                <td>{{$project -> name}}</td>
                <td>{{$project -> description}}</td>
                <td>{{$project -> status}}</td>
                <td>{{count($project -> contactPerson)}}</td>
                <td>
                    <a class="btn btn-primary" href="/project/{{$project -> id}}/edit">edit</a>
                </td>
                <td>
                    <button type="button" class="btn btn-danger x-project">x</button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-end">
            @for ($i = 1; $i < $projects ->lastPage()+1; $i++)
                @if($projects -> currentPage() == $i)
                    <li class="page-item active disabled"><a class="page-link" href="/projects/{{$i}}/{{$order_by}}">{{$i}}</a></li>
                @else
                    <li class="page-item"><a class="page-link" href="/projects/{{$i}}/{{$order_by}}">{{$i}}</a></li>

                @endif
            @endfor

        </ul>
    </nav>

    <form id="delete-project" class="d-none" action="" method="post">
        @csrf
        @method('delete')
    </form>
@endsection
