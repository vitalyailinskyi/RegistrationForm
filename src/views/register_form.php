<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width"/>
    <title>Registration</title>
    <link rel="stylesheet" href="../css/index.css" type="text/css"/>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap">
</head>
<body>
    <div class="container">
        <div class="form-container">
            <div class="registration">
                <h1 class="header">Registration</h1>
                <form class="registration-form" method="POST" action="/BasicRegistration/public/register">
                    <label for="name">Username</label>
                    <input type="text" name="name" placeholder="Name" id="name">
                    <label for="email">E-mail</label>
                    <input type="email" name="email" id="email" placeholder="Email">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" placeholder="Password"><br>
                    <button type="submit">Register</button>
                </form>
                <div class="popup-container">
                    <?php if (!empty($_SESSION['message'])): ?>
                        <div class="popup <?= $_SESSION['message_type'] ?>">
                            <?= htmlspecialchars($_SESSION['message']) ?>
                        </div>
                        <?php unset($_SESSION['message'], $_SESSION['message_type']); ?>
                    <?php endif; ?>
                </div>
            </div>

        </div>
    </div>

    <script type="text/javascript" src="../js/popup.js"></script>
</body>
</html>