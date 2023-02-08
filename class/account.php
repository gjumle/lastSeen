<?php
class Account {
    private static $name;
    private static $password;
    private static $email;
    private static $city;
    private static $nameErr;
    private static $passwordErr;
    private static $emailErr;
    private static $cityErr;

    public static function renderForm() {
        if (isset($_GET['action']) && $_GET['action'] == "register") {
            return "
            <div class='account-form'>
                <form action='' method='post'>
                    <div class='form-field>
                        <label for='name'>Name:</label>
                        <input type='text' name='name'>
                        <span class='error'>*" . self::$nameErr . "</span>
                    <div>
                    
                    <div class='form-field>
                        <label for='password'>Password:</label>
                        <input type='password' name='password'>
                        <span class='error'>*" . self::$passwordErr . "</span>
                    <div>
                    
                    <div class='form-field>
                        <label for='email'>E-mail:</label>
                        <input type='email' name='email'>
                        <span class='error'>*" . self::$emailErr . "</span>
                    <div>
                    
                    <div class='form-field>
                        <label for='city'>City:</label>
                        <input type='text' name='city'>
                        <span class='error'>*" . self::$cityErr . "</span>
                    <div>

                    <div class='form-field>
                        <input type='submit' name='register'>
                    <div>
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
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (empty($_POST['name'])) {
                self::$nameErr = 'Name is required';
            } else {
                self::$name = trim($_POST['name']);
            }

            if (empty($_POST['password'])) {
                self::$passwordErr = 'Password is required';
            } else {
                self::$password = md5($_POST['password']);
            }

            if (empty($_POST['email'])) {
                self::$emailErr = 'Email is required';
            } else {
                self::$email = $_POST['email'];
            }

            if (empty($_POST['city'])) {
                self::$cityErr = 'City is required';
            } else {
                self::$city = $_POST['city'];
            }

        }
        if (isset($_POST['register'])) {
            $registerUser = new User (null, self::$name, self::$password, null, self::$email, self::$city);
            $registerUser->insertToDB();
        }
        if (isset($_POST['login'])) {
            $loginUser = new User (null, self::$name, self::$password, null, null, null);
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