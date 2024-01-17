<!DOCTYPE html>

<head>
    <?php require_once __DIR__.'/../Sections/Header.php'; ?>
</head>

<body class="bg-black ">
    <?php require_once __DIR__.'/../Sections/Nav.php'; ?>
    <div class="container-fluid">
        <div class="row h-100 justify-content-center">
            <div class="col-8 col-md-6 col-lg-4 col-xl-3 border p-4 p-4">
                <h1 class="pb-2 text-white">Invite</h1>
                <p class="pb-2 text-white">Enter the email address to send an invite for the user to create an account.</p>
                <form id="login" action="/invite" method="post">
                    <div method="post">
                        <label for="email" class="text-light">Email</label>
                        <input class="form-control" name="email" autocomplete="off" required>
                        <?php \App\Message($vars); ?>
                    </div>
                    <button class="btn btn-light mt-4" type="submit" value="Login">Send</button>
                </form>
            </div>
        </div>
    </div>
</body>

</HTML>