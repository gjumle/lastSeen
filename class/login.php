<?php
class Login {

    public static function renderForm() {
        if (isset($_GET['action']) && $_GET['action'] == "new") {
            return "
                <form action='' method='post'>
                    <label for='name'>Name:</label>
                    <input type='text' name='name'>
                    
                    <label for='password'>Password:</label>
                    <input type='password' name='password'>
                    
                    <label for='email'>E-mail:</label>
                    <input type='email' name='email'>
                    
                    <label for='city'>City:</label>
                    <input type='text' name='city'>

                    <input type='submit' name='register'>
                </form>";
        } elseif (isset($_GET['action']) && $_GET['action'] == 'logout') {
            setcookie('uid', '', time() - 3600);
            setcookie('password', '', time() - 3600);
            setcookie('admin', '', time() - 3600);
            setcookie('email', '', time() - 3600);
            setcookie('city', '', time() - 3600);
            return "<span>Logout success</span>";
        } elseif (isset($_GET['action']) && $_GET['action'] == 'login') {
            return "
                <form action='' method='post'>
                    <label for='name'>Name:</label>
                    <input type='text' name='name'>

                    <label for='password'>Password:</label>
                    <input type='password' name='password'>

                    <input type='submit' name='login'>
                </form>";
        }
    }

    public static function formHandler() {
        $password = (isset($_POST['password'])) ? md5($_POST['password']) : "";
        if (isset($_POST['register'])) {
            $registerUser = new User (null, $_POST['name'], $password, null, $_POST['email'], $_POST['city']);
            $registerUser->insertToDB();
            echo "<script type='text/javascript'>window.location.replace('account.php');</script>";
        }
        if (isset($_POST['login'])) {
            $loginUser = new User (null, $_POST['name'], $password, null, null, null);
            if ($loginUser->checkDB() > 0) {
                $loginUser = UserManager::getUser($loginUser->checkDB());
                setcookie('uid', $loginUser->getId(), time() + (86400 * 30), '/');
                setcookie('password', $loginUser->getPassword(), time() + (86400 * 30), '/');
                setcookie('admin', $loginUser->getAdmin(), time() + (86400 * 30), '/');
                setcookie('email', $loginUser->getEmail(), time() + (86400 * 30), '/');
                setcookie('city', $loginUser->getCity(), time() + (86400 * 30), '/');
                echo "<script type='text/javascript'>window.location.replace('account.php');</script>";
            } else {
                return "<span>Inccorect name or password";
            }
        }
    }

    public static function renderLoginForm() {
        self::formHandler();
        $form = Login::renderForm();

        return $form;
    }
}