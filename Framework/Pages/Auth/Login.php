<!DOCTYPE html>
<HTML>

<head>
    <?php require_once __DIR__.'/../Sections/Header.php'; ?>
    <link rel="stylesheet" href="/css/login.css">
</head>

<body class="bg-black">
  <div class="container" style="height: 100vh">
    <div class="row h-100 justify-content-center align-items-center">
      <div class="col-12 col-md-6 col-lg-4 border p-4">
        <h1 class="pb-2 text-white">
          <center><?php echo $_settings['TITLE']; ?></center>
        </h1>
          <?php \App\Message($vars); ?>
        <form id="login" action="/login" method="post">
          <div method="post">
            <label for="username" class="text-light">Username\Email</label>
            <input class="form-control" name="username" autocomplete="off" required>
          </div>
          <div method="post">
            <label for="password" class="text-light pt-2">Password</label>
            <input type="password" class="form-control" name="password" autocomplete="off" required>
          </div>
          <div class="pt-2 text-end">
            <a class="text-info" href="/reset">Forgot password?</a>
          </div>
          <button class="btn btn-light" type="submit" value="Login">Login</button>
        </form>
      </div>
    </div>
  </div>
</body>

</HTML>