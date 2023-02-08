<?php
class Account {

    public static function renderForm() {
        if (isset($_GET['action']) && $_GET['action'] == "register") {
            return "
            <div class='account-form'>
                <form action='' method='post'>
                    <label for='name'>Name:</label>
                    <input type='text' name='name'>
                    <span class='error'>*" . $nameErr . "</span>
                    <br><br>
                    
                    <label for='password'>Password:</label>
                    <input type='password' name='password'>
                    <span class='error'>*" . $passwordErr . "</span>
                    <br><br>
                    
                    <label for='email'>E-mail:</label>
                    <input type='email' name='email'>
                    <span class='error'>*" . $emailErr . "</span>
                    <br><br>
                    
                    <label for='city'>City:</label>
                    <input type='text' name='city'>
                    <span class='error'>*" . $cityErr . "</span>
                    <br><br>

                    <input type='submit' name='register'>
                </form>
            </div>";
        } elseif (isset($_GET['action']) && $_GET['action'] == 'login') {
            return "
            <div class='account-form'>
                <form action='" . htmlspecialchars($_SERVER['PHP_SELF']) . "' method='post'>
                    <label for='name'>Name:</label>
                    <input type='text' name='name'>

                    <label for='password'>Password:</label>
                    <input type='password' name='password'>

                    <input type='submit' name='login'>
                </form>
            </div>";
        }
    }

    public static function formHandler() {
        $nameErr = $passwordErr = $emailErr = $cityErr = '';
        $name = $password = $email = $city = '';

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (empty($_POST['name'])) {
                $nameErr = 'Name is required';
            } else {
                $name = trim($_POST['name']);
            }

            if (empty($_POST['password'])) {
                $passwordErr = 'Password is required';
            } else {
                $password = md5($_POST['password']);
            }

            if (empty($_POST['email'])) {
                $emailErr = 'Email is required';
            } else {
                $email = $_POST['email'];
            }

            if (empty($_POST['city'])) {
                $cityErr = 'City is required';
            } else {
                $city = $_POST['city'];
            }

        }
        if (isset($_POST['register'])) {
            $registerUser = new User (null, $name, $password, null, $email, $city);
            $registerUser->insertToDB();
        }
        if (isset($_POST['login'])) {
            $loginUser = new User (null, $name, $password, null, null, null);
            if ($loginUser->checkDB() > 0) {
                $loginUser = UserManager::getUser($loginUser->checkDB());
                setcookie('logged_in', true, time() + (86400 * 30));
                setcookie('uid', $loginUser->getId(), time() + (86400 * 30));
                setcookie('name', $loginUser->getName(), time() + (86400 * 30));
                setcookie('password', $loginUser->getPassword(), time() + (86400 * 30));
                setcookie('admin', $loginUser->getAdmin(), time() + (86400 * 30));
                setcookie('email', $loginUser->getEmail(), time() + (86400 * 30));
                setcookie('city', $loginUser->getCity(), time() + (86400 * 30));
                echo "<script type='text/javascript'>window.location.replace('userAccount.php');</script>";
            } else {
                return "<span>Inccorect name or password";
            }
        }
    }

    public static function renderLoginForm() {
        self::formHandler();
        $form = self::renderForm();

        return $form;
    }
}