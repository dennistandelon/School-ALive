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
            <a class="navbar-brand" href="#">[School ALive] Admin Dashboard - Student</a>
            <span class="d-flex">
                <form class="d-flex" action="/admin" method="GET">
                    <button class="btn btn-outline-primary" type="submit">Manage Course</button>
                </form>
                <form class="d-flex" action="/admin-lecturer" method="GET">
                    <button class="btn btn-outline-primary" type="submit">Manage Lecturer</button>
                </form>
                <form class="d-flex" action="/logout" method="GET">
                    <button class="btn btn-outline-danger" type="submit">Logout</button>
                </form>
            </span>
            <form class="d-flex" action={{url('/admin-student/search')}} method="GET">
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
                <td scope="col">Course Taken</td>
                <td scope="col">Action</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($students as $student)
                <tr scope="row">
                    <td>{{$student->id}}</td>
                    <td>{{$student->fullname}}</td>
                    <td><img width="200px" height="200px" src="{{Storage::url($student->imageurl)}}" alt="Lecturer Image" srcset="{{Storage::url($student->imageurl)}}"></td>
                    <td>
                        @foreach ($student->Courses as $detail)
                            <div>{{$detail->title}}</div>
                        @endforeach
                    </td>
                    <td>
                        <form action="/admin-student/loginas/{{$student->id}}" method="GET">
                            @csrf
                            <button type="submit" class="btn btn-secondary" onclick="">Login As</button>
                        </form>
                        <form action="/admin-student/delete/{{$student->id}}" method="post">
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
        {{$students->withQueryString()->links()}}
    </div>
    <form enctype="multipart/form-data" action="/student/new" method="POST">
        @csrf
        <h4>Insert new Student</h4>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label" for="titles">Fullname</label>
            <div class="col-sm-10">
                <input class="form-control" type="text" name="fullname" id="titles">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label" for="images">Description</label>
            <div class="col-sm-10">
                <input class="form-control" type="file" name="image" id="images">
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Insert</button>
    </form>
</body>
</html>
