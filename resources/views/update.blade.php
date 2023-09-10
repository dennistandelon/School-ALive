<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>School ALive - {{$course->title}}</title>

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
        <form enctype="multipart/form-data" action="/admin" method="GET">
            @csrf
            <button type="submit" class="btn btn-danger">< Return to Admin Page</button>
        </form>
        <div>Title: {{$course->title}}</div>
        <div>Description: {{$course->desc}}</div>
    </div>


    <h4>Course Detail</h4>
    <table id="courseTable" class="table table-bordered">
        <thead>
            <tr>
                <td scope="col">Module</td>
                <td scope="col">Description</td>
                <td scope="col">Action</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($course->details as $detail)
                <tr scope="row">
                    <td>{{$detail->title}}</td>
                    <td>{{$detail->desc}}</td>
                    <td>
                        <form enctype="multipart/form-data" action="/detail/delete/{{$detail->id}}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-danger">DELETE</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h4>Student List</h4>
    <table id="studentTable" class="table table-bordered">
        <thead>
            <tr>
                <td scope="col">Student ID</td>
                <td scope="col">Fullname</td>
                <td scope="col">Action</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($course->students as $detail)
                <tr scope="row">
                    <td>{{$detail->id}}</td>
                    <td>{{$detail->fullname}}</td>
                    <td>
                        <form enctype="multipart/form-data" action="/coursestudent/delete/{{$course->id}}/{{$detail->id}}" method="post">
                            {{method_field('DELETE')}}
                            @csrf
                            <button type="submit" class="btn btn-danger">DELETE</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <form enctype="multipart/form-data" action="/course/update" method="POST">
        @csrf
        <h4>Update Course Detail</h4>
        <div class="form-group row" hidden>
            <label class="col-sm-2 col-form-label" for="course_id">Id</label>
            <div class="col-sm-10">
                <input class="form-control" type="text" name="course_id" id="course_id" placeholder="{{$course->id}}" value="{{$course->id}}" hidden>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label" for="titles">Title</label>
            <div class="col-sm-10">
                <input class="form-control" type="text" name="title" id="titles" placeholder="{{$course->title}}" value="{{$course->title}}">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label" for="description">Description</label>
            <div class="col-sm-10">
                <input class="form-control" type="text" name="desc" id="description" placeholder="{{$course->desc}}" value="{{$course->desc}}">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label" for="lec">Lecturer</label>
            <div class="col-sm-10">
                <select name="lec" id="lec">
                    @foreach ($lecturers as $lecturer)
                        <option value="{{$lecturer->id}}">{{$lecturer->fullname}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>

    <form enctype="multipart/form-data" action="/detail/new" method="POST">
        @csrf
        <h4>Add new Detail</h4>
        <div class="form-group row" hidden>
            <label class="col-sm-2 col-form-label" for="course_ids">Course Id</label>
            <div class="col-sm-10">
                <input class="form-control" type="text" name="course_id" id="course_ids" placeholder="{{$course->id}}" value="{{$course->id}}" hidden>
            </div>
        </div>
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
        <button type="submit" class="btn btn-primary">Add</button>
    </form>

    <form action="/coursestudent/new" method="post">
        @csrf
        <h4>Add Student</h4>
        <div class="form-group row" hidden>
            <div class="col-sm-10">
                <input class="form-control" type="text" name="cid" id="cid" value="{{$course->id}}">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label" for="students">Students</label>
            <div class="col-sm-10">
                <select name="students[]" id="students" multiple>
                    @foreach ($students as $student)
                        <option value="{{$student->id}}">{{$student->fullname}}</option>
                    @endforeach
                </select>
                <div>CTRL/CMD + Click to select multiple</div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Add</button>
    </form>
</body>
</html>
