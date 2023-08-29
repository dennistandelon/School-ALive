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
</head>
<body>
    <table id="courseTable" class="table table-bordered">
        <thead>
            <tr>
                <td scope="col">Id</td>
                <td scope="col">Title</td>
                <td scope="col">Description</td>
                <td scope="col">Created At</td>
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
                        <input type="button" value="VIEW">
                        <input type="button" value="UPDATE">
                        <input type="button" value="DELETE">
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>


    <form enctype="multipart/form-data" action="/newcourse" method="POST">
        @csrf
        <div>Create new Course</div>
        <div>
            <label for="titles">Title</label>
            <input type="text" name="title" id="titles" placeholder="Title">
        </div>
        <div>
            <label for="description">Description</label>
            <input type="text" name="desc" id="description" placeholder="Description">
        </div>
        <div>
            <button type="submit">Submit</button>
        </div>

    </form>
</body>
</html>
