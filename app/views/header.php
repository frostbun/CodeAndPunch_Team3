<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Classrom Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="/script.js"> </script>
  </head>

  <body>
    <header>
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
          <a class="navbar-brand" href="/">Classroom Management</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav me-auto mb-3 mb-lg-0">
              <?php
                if(isset($_SESSION["user"])) {
                  echo '<a class="nav-link active" href="/manage">Students</a>';
                  echo '<a class="nav-link active" href="/homework">Homeworks</a>';
                  echo '<a class="nav-link active" href="/game">Games</a>';
                }
              ?>
            </div>
            <div class="navbar-nav ml-auto mb-3 mb-lg-0">
              <?php
                if(isset($_SESSION["user"])) {
                  echo '<a class="nav-link active" href="/logout">Logout</a>';
                }
                else {
                  echo '<a class="nav-link active" href="/login">Login</a>';
                  echo '<a class="nav-link active" href="/register">Register</a>';
                }
              ?>
            </div>
          </div>
        </div>
      </nav>
    </header>