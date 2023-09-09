<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>School ALive - Administrator</title>

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <style>
        form{
            max-width: 700px;
            margin-left: 10px;
            margin-top: 20px;
        }
    </style>
    <script>

    </script>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">[School ALive] Admin Dashboard - Lecturer</a>
            <form class="d-flex" action="/logout" method="GET">
                <button class="btn btn-outline-danger" type="submit">Logout</button>
            </form>
            <form class="d-flex" action={{url('/admin/search')}} method="GET">
              <input class="form-control me-2" type="search" name="search" placeholder="Search" aria-label="Search">
              <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </div>
      </nav>
    <table id="courseTable" class="table table-bordered">
        <thead>
            <tr>
                <td scope="col">Id</td>
                <td scope="col">Name</td>
                <td scope="col">Image Url</td>
                <td scope="col">Course Teach</td>
                <td scope="col">Action</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($lecturers as $lecturer)
                <tr scope="row">
                    <td>{{$lecturer->id}}</td>
                    <td>{{$lecturer->fullname}}</td>
                    <td><img width="200px" height="200px" src="{{Storage::url($lecturer->imageurl)}}" alt="Lecturer Image" srcset="{{Storage::url($lecturer->imageurl)}}"></td>
                    <td>
                        @foreach ($lecturer->Courses as $detail)
                            <div>{{$detail->title}}</div>
                        @endforeach
                    </td>
                    <td>
                        <form action="/admin-lecturer/update/{{$lecturer->id}}" method="GET">
                            @csrf
                            <button type="submit" class="btn btn-secondary" onclick="">UPDATE</button>
                        </form>
                        <form action="/lecturer/delete/{{$lecturer->id}}" method="post">
                            {{method_field('DELETE')}}
                            @csrf
                            <button type="submit" class="btn btn-danger">DELETE</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="pagination">
        {{$lecturers->withQueryString()->links()}}
    </div>
    <form enctype="multipart/form-data" action="/lecturer/new" method="POST">
        @csrf
        <h4>Insert new Lecturer</h4>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label" for="titles">Full Name</label>
            <div class="col-sm-10">
                <input class="form-control" type="text" name="fullname" id="titles" placeholder="Title">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label" for="specs">Specialization</label>
            <div class="col-sm-10">
                <input class="form-control" type="text" name="special" id="specs" placeholder="Lecturer Specialization">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label" for="images">Image</label>
            <div class="col-sm-10">
                <input class="form-control" type="file" name="image" id="images">
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</body>
</html>
