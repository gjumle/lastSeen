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
        } else {
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


}