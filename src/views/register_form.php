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
            <div class="registration-container">
                <h1 class="header">Registration</h1>
                <form class="registration-form" method="POST" action="/BasicRegistration/public/register">
                    <fieldset class="fieldset-container">
                        <div class="field-container">
                            <input type="text" name="name" id="name" required minlength="3" placeholder=" ">
                            <label for="name">Username</label>
                        </div>
                        <div class="field-container">
                            <input type="email" name="email" id="email" placeholder=" " required pattern="^[\w.+\-]+@.+\..+$">
                            <label for="email">E-mail</label>
                        </div>
                        <div class="field-container">
                            <input type="password" name="password" id="password" placeholder=" " required>
                            <label for="password">Password</label>
                        </div>
                    </fieldset>
                    <button type="submit">Register</button>
                </form>
            </div>

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