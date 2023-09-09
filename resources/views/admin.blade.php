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
            <a class="navbar-brand" href="#">[School ALive] Admin Dashboard</a>
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
                <td scope="col">Title</td>
                <td scope="col">Description</td>
                <td scope="col">Created At</td>
                <td scope="col">Last Updated</td>
                <td scope="col">Details</td>
                <td scope="col">Action</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($courses as $course)
                <tr scope="row">
                    <td>{{$course->id}}</td>
                    <td>{{$course->title}}</td>
                    <td>{{$course->desc}}</td>
                    <td>{{$course->created_at}}</td>
                    <td>{{$course->updated_at}}</td>
                    <td>
                        @foreach ($course->details as $detail)
                            <div>{{$detail->title}}</div>
                        @endforeach
                    </td>
                    <td>
                        <form action="/admin/update/{{$course->id}}" method="GET">
                            @csrf
                            <button type="submit" class="btn btn-secondary" onclick="">UPDATE</button>
                        </form>
                        <form action="/course/delete/{{$course->id}}" method="post">
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
        {{$courses->withQueryString()->links()}}
    </div>
    <form enctype="multipart/form-data" action="/course/new" method="POST">
        @csrf
        <h4>Create new Course</h4>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label" for="titles">Title</label>
            <div class="col-sm-10">
                <input class="form-control" type="text" name="title" id="titles" placeholder="Title">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label" for="description">Description</label>
            <div class="col-sm-10">
                <input class="form-control" type="text" name="desc" id="description" placeholder="Description">
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</body>
</html>
