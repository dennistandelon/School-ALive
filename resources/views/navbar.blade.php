<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
 </head>
<body>
    <div class="d-flex flex-row" style="min-height: 100vh">
        <div class="d-flex flex-column flex-shrink-0 p-3 bg-body-tertiary" style="width: 280px;">
            <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
              <svg class="bi pe-none me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
              <span class="fs-4">Learning Management System</span>
            </a>
            <hr>
            <ul class="nav nav-pills flex-column mb-auto">
              <li class="nav-item">
                <a href="#" class="nav-link active" aria-current="page">
                  <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#home"></use></svg>
                  Home
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link" aria-current="page">
                  <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#home"></use></svg>
                  Profile
                </a>
              </li>
            </ul>
            <hr>
          </div>
          <div>
              @yield('content')
          </div>
    </div>

</body>
</html>
