@extends('navbar')

@section('title','School ALive')

@section('content')
    <div style="display:block;">Welcome, <strong>{{$student->fullname}}</strong></div>
    <div style="display: block;">
        <div class="d-flex flex-wrap">
            @foreach ($courses as $course)
                <div class="card" style="width: 18rem;height: 12rem;">
                    <div class="card-body">
                        <h5 class="card-title">{{$course->title}}</h5>
                        <p class="card-text">{{$course->desc}}</p>
                        <a href="#" class="card-link">View Course</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
