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
                    <div class='form-field'>
                        <label for='name'>Name:</label>
                        <span class='error'>*" . self::$nameErr . "</span>
                        <input type='text' name='name'>
                    </div>
                    
                    <div class='form-field'>
                        <label for='password'>Password:</label>
                        <span class='error'>*" . self::$passwordErr . "</span>
                        <input type='password' name='password'>
                    </div>
                    
                    <div class='form-field'>
                        <label for='email'>E-mail:</label>
                        <span class='error'>*" . self::$emailErr . "</span>
                        <input type='email' name='email'>    
                    </div>

                    <div class='form-field'>
                        <label for='city'>City:</label>
                        <span class='error'>*" . self::$cityErr . "</span>
                        <input type='text' name='city'> 
                    </div>

                    <div class='form-field'>
                        <label for='city'>Register:</label>
                        <input type='submit' name='register'>
                    </div>
                </form>
            </div>";
        } elseif (isset($_GET['action']) && $_GET['action'] == 'login') {
            return "
            <div class='account-form-login'>
                <form action='" . htmlspecialchars($_SERVER['PHP_SELF']) . "' method='post'>
                    <div class='form-field'>
                        <label for='name'>Name:</label>
                        <span class='error'>*" . self::$nameErr . "</span>
                        <input type='text' name='name'>
                    </div>

                    <div class='form-field'>
                        <label for='password'>Password:</label>
                        <span class='error'>*" . self::$passwordErr . "</span>
                        <input type='password' name='password'>
                    </div>

                    <div class='form-field'>
                        <label for='password'>Login:</label>
                        <input type='submit' name='login'>
                    </div>
                </form>
            </div>";
        }
    }

    public static function requireFields($formType) {
        // Checks if the POSTs are filled up
        // Checks the POSTs based on form type 
        if ($formType == 'login') {
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
        } elseif ($formType == 'register') {
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
                self::$email = trim($_POST['email']);
            }
            if (empty($_POST['city'])) {
                self::$cityErr = 'City is required';
            } else {
                self::$city = trim($_POST['city']);
            }
        }
    }

    public static function formHandler() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['register'])) {
                // Form validation
                Account::requireFields('register');
                $registerUser = new User (null, self::$name, self::$password, null, self::$email, self::$city);
                // Save user to DB
                $registerUser->insertToDB();
            }
            if (isset($_POST['login'])) {
                // Form validation
                Account::requireFields('login');
                $loginUser = new User (null, self::$name, self::$password, null, null, null);
                // Compare name and password from DB with the POST data
                if ($loginUser->checkDB() > 0) {
                    $loginUser = UserManager::getUser($loginUser->checkDB());
                    setcookie('logged_in', true, time() + (86400 * 30));
                    setcookie('uid', $loginUser->getId(), time() + (86400 * 30));
                    setcookie('name', $loginUser->getName(), time() + (86400 * 30));
                    setcookie('password', $loginUser->getPassword(), time() + (86400 * 30));
                    setcookie('admin', $loginUser->getAdmin(), time() + (86400 * 30));
                    setcookie('email', $loginUser->getEmail(), time() + (86400 * 30));
                    setcookie('city', $loginUser->getCity(), time() + (86400 * 30));
                    echo "<script type='text/javascript'>window.location.replace('index.php');</script>";
                } else {
                    return "<span>Inccorect name or password";
                }
            }
        }
    }

    public static function renderLoginForm() {
        self::formHandler();
        $form = self::renderForm();

        return $form;
    }
}