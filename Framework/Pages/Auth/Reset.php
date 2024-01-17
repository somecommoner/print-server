<!DOCTYPE html>
<HTML>

<head>
    <?php require_once __DIR__.'/../Sections/Header.php'; ?>
</head>

<body class="bg-black ">
    <div class="container" style="height: 100vh">
        <div class="row h-100 justify-content-center align-items-center">
            <div class="col-12 col-md-6 col-lg-5 col-xl-4 border p-4">
                <h1 class="pb-2 text-white">
                    Reset password</h1>
                <p class="text-white">
                    An email will be sent if there is an active account with the email address entered.</p>
                <form id="reset" action="/reset" method="post">
                    <div method="post">
                        <label for="email" class="text-light">
                            Email</label>
                        <input class="form-control" name="email" autocomplete="off" required>
                    </div>
                    <div class="pb-2 text-danger">
                    </div>
                    <button class="btn btn-light mt-3" type="submit" value="Reset">
                        Send</button>
                </form>
            </div>
        </div>
    </div>
</body>

</HTML>