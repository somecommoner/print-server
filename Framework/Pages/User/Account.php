<!DOCTYPE html>

<head>
    <?php require_once __DIR__ . '/../Sections/Header.php'; ?>
    <link rel="stylesheet" href="/css/account.css">
    <script type="text/javascript" src="/js/account.js"></script>
</head>

<body class="bg-black  pb-4">
    <?php require_once __DIR__ . '/../Sections/Nav.php'; ?>
    <div class="container">
        <h1 class="text-white pb-4 pl-4">
            Account</h1>
        <div class="accordian" id="accordian">
            <div class="card bg-transparent border-secondary">
                <div class="card-header" id="username">
                    <h5 class="mb-0">
                        <button class="btn btn-link btn-block text-left text-white" type="button" data-toggle="collapse"
                            data-target="#collapseUsername" aria-expanded="true" aria-controls="collapseUsername">
                            <h3>Change Username</h3>
                        </button>
                    </h5>
                </div>
            </div>
            <div id="collapseUsername" class="collapse show" aria-labelledby="username" data-parent="#accordian">
                <div class="card-body p-4 text-white col-12 col-md-6 col-lg-5 col-xl-4">
                    <form id="username" class="pb-2">
                        <div>
                            <label for="username" class="text-light">
                                New username</label>
                            <input id="username-text" class="form-control" name="username" autocomplete="off"
                                placeholder="<?php echo $_SESSION['username']; ?>" required>
                            <div id="username-result" class="pb-0">
                            </div>
                        </div>
                        <button id="btn-change-username" class="btn btn-light mt-4" value="username">
                            Change</button>
                    </form>
                </div>
            </div>
            <div class="card bg-transparent border-secondary">
                <div class="card-header" id="password">
                    <h5 class="mb-0">
                        <button class="btn btn-link btn-block text-left text-white" type="button" data-toggle="collapse"
                            data-target="#collapsePassword" aria-expanded="true" aria-controls="collapsePassword">
                            <h3>Change Password</h3>
                        </button>
                    </h5>
                </div>
            </div>
            <div id="collapsePassword" class="collapse" aria-labelledby="password" data-parent="#accordian">
                <div class="card-body p-4 text-white col-12 col-md-6 col-lg-5 col-xl-4">
                    <p>Password must be at least 8 characters and contain uppercase, lowercase and numbers.</p>
                    <form id="password" class="pb-2">
                        <div class="pb-3">
                            <label for="password" class="text-light pt-1">
                                Current Password</label>
                            <input id="current-password" type="password" class="form-control" name="current-password"
                                autocomplete="off" required>
                        </div>
                        <div class="pb-2">
                            <label for="password" class="text-light pt-1">
                                New Password</label>
                            <input id="new-password" type="password" class="form-control" name="password"
                                autocomplete="off" required>
                        </div>
                        <label class="text-light pt-2">
                            Confirm Password</label>
                        <input id="confirm-password" type="password" class="form-control" autocomplete="off" required>
                        <div id="password-result" class="pb-0">
                        </div>
                        <button id="btn-change-password" class="btn btn-light mt-4" type="submit" value="password"
                            disabled>
                            Reset</button>
                    </form>
                </div>
            </div>
            <div class="card bg-transparent border-secondary">
                <div class="card-header" id="email">
                    <h5 class="mb-0">
                        <button class="btn btn-link btn-block text-left text-white" type="button" data-toggle="collapse"
                            data-target="#collapseEmail" aria-expanded="true" aria-controls="collapseEmail">
                            <h3>Change Email</h3>
                        </button>
                    </h5>
                </div>
            </div>
            <div id="collapseEmail" class="collapse" aria-labelledby="email" data-parent="#accordian">
                <div class="card-body p-4 text-white col-12 col-md-6 col-lg-5 col-xl-4">
                    <p>An email will be sent to the new email address with a validation link.</p>
                    <form id="email" class="pb-2">
                        <div>
                            <label for="email" class="text-light">
                                New email</label>
                            <input id="email-text" class="form-control" name="email" autocomplete="off"
                                placeholder="<?php echo $_SESSION['email']; ?>" required>
                            <div id="email-result" class="pb-0">
                            </div>
                        </div>
                        <button id="btn-change-email" class="btn btn-light mt-4" value="email">
                            Change</button>
                    </form>
                </div>
            </div>
            <div class="card bg-transparent border-secondary">
                <div class="card-header" id="logonSettings">
                    <h5 class="mb-0">
                        <button class="btn btn-link btn-block text-left text-white" type="button" data-toggle="collapse"
                            data-target="#collapseLogonSettings" aria-expanded="true" aria-controls="collapseLogonSettings">
                            <h3>Logon Settings</h3>
                        </button>
                    </h5>
                </div>
            </div>
            <div id="collapseLogonSettings" class="collapse" aria-labelledby="logonSettings" data-parent="#accordian">
                <div class="card-body p-4 text-white col-12 col-md-6 col-lg-5 col-xl-4">
                    <p>Auto logon for your IP address?.</p>
                    <form id="logonSettings" class="pb-2">
                        <div>
                            <label for="logonSettings" class="text-light">
                                New logonSettings</label>
                            <input id="logonSettings-text" class="form-control" name="logonSettings" autocomplete="off"
                                placeholder="<?php echo $_SESSION['logonSettings']; ?>" required>
                            <div id="logonSettings-result" class="pb-0">
                            </div>
                        </div>
                        <button id="btn-change-logonSettings" class="btn btn-light mt-4" value="logonSettings">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</HTML>