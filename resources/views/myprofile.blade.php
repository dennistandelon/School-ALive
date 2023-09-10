@extends('navbar')

@section('title','School ALive - My Profile')

@section('home','')
@section('profile','active')

@section('content')
<div>
    <div>Name: {{$person->fullname}}</div>
    <div>
        <td><img width="200px" height="200px" src="{{Storage::url($person->imageurl)}}" alt="Lecturer Image" srcset="{{Storage::url($person->imageurl)}}"></td>
    </div>
    <div>{{(isset($person->specialization))?'Specialization: '.$person->specialization : ''}}</div>

    <form enctype="multipart/form-data" action="/profile/update" method="POST">
        @csrf
        <h4>Update Profile</h4>
        <div class="form-group row" hidden>
            <div class="col-sm-10">
                <input class="form-control" type="text" name="user_id" id="user_id" value="{{$person->id}}" hidden>
            </div>
        </div>
        <div class="form-group row" hidden>
            <div class="col-sm-10">
                <input class="form-control" type="text" name="status" id="status" value="{{$stats}}" hidden>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label" for="titles">Full Name</label>
            <div class="col-sm-10">
                <input class="form-control" type="text" name="fullname" id="titles" value="{{$person->fullname}}">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label" for="description">Image</label>
            <div class="col-sm-10">
                <input class="form-control" type="file" name="image" id="description">
            </div>
        </div>
        @if ($stats == 'lecturer')
        <div class="form-group row">
            <label class="col-sm-2 col-form-label" for="special">Specialization</label>
            <div class="col-sm-10">
                <input class="form-control" type="text" name="specialization" id="special" value="{{$person->specialization}}">
            </div>
        </div>
        @endif
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
