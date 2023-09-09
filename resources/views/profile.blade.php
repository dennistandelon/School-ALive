<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>School ALive - {{$person->fullname}}</title>

    {{-- Bootstrap--}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <style>
        form{
            max-width: 700px;
            margin-left: 10px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div>
        <form enctype="multipart/form-data" action="/admin-lecturer" method="GET">
            @csrf
            <button type="submit" class="btn btn-danger">< Return to Admin Page</button>
        </form>
        <h1>Admin {{$type}} Profile Editor</h1>
        <div>Name: {{$person->fullname}}</div>
        <div>
            <td><img width="200px" height="200px" src="{{Storage::url($person->imageurl)}}" alt="Lecturer Image" srcset="{{Storage::url($person->imageurl)}}"></td>
        </div>
        <div>{{(isset($person->specialization))?'Specialization: '.$person->specialization : ''}}</div>
    </div>
</body>
</html>
