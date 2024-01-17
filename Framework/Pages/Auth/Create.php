<!DOCTYPE html>

<head>
    <?php require_once __DIR__.'/../Sections/Header.php'; ?>
    <link rel="stylesheet" href="/css/login.css">
    <script type="text/javascript" src="/js/validate-password.js"></script>
</head>

<body class="bg-black ">
    <div class="container" style="height: 100vh">
        <div class="row h-100 justify-content-center align-items-center">
            <div class="col-12 col-md-6 col-lg-5 col-xl-4 border p-4">
                <h1 class="pb-2 text-white">Create Account</h1>
                <p class="text-white">Password must be at least 8 characters and contain a number.</p>
                <form id="login" action="/create/<?php echo $vars['token']?>" method="post">
                    <div method="post" class="pb-3">
                        <label for="username" class="text-light">Username</label>
                        <input class="form-control" name="username" autocomplete="off" required>
                    </div>
                    <div method="post">
                        <label for="password" class="text-light pt-1">Password</label>
                        <input id="password" type="password" class="form-control" name="password" autocomplete="off" required>
                    </div>
                    <label class="text-light pt-2">Confirm Password</label>
                    <input id="confirm-password" type="password" class="form-control" autocomplete="off" required>
                    <button id="button-create" class="btn btn-light mt-4" type="submit" value="Login" disabled>Create</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>