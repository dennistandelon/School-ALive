<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>School ALive - Login</title>
</head>
<body>
    <form enctype="multipart/form-data" action="/login" method="get">
        <div class="form-group row">
            <label class="col-sm-2 col-form-label" for="email">Email</label>
            <div class="col-sm-10">
                <input class="form-control" type="email" name="email" id="email" >
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label" for="pass">Password</label>
            <div class="col-sm-10">
                <input class="form-control" type="password" name="pass" id="pass">
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>
    <div>Contact admin for account request (support@schoolalive.edu)</div>
</body>
</html>

