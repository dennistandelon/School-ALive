@extends('navbar')

@section('title','School Alive - '.$course->title)

@section('content')
<h1>{{$course->title}}</h1>
<div>{{$course->desc}}</div>
<div>Lecturer: <strong> {{$lecturer->fullname}}</strong></div>
<div>Students:
    @foreach ($course->Students as $student)
        <div>{{$student->fullname}}</div>
    @endforeach
</div>

@endsection

