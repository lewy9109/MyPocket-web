<?php
    session_start();
    if(isset($_POST['login']))
    {
        //Udana walidacja tak
        $everything_good = true;

        //sprawdz loginu
        $login = $_POST['login'];

        //sprawdzenie dlugosci loginu
        if((strlen($login) < 3) || (strlen($login)>20))
        {
            $everything_good = false;
            $_SESSION['e_login'] = "login musi posiadać od 3 do 20 znaków!";
        }
        
        if(ctype_alnum($login) == false)
        {
            $everything_good = false;
            $_SESSION['e_login'] = "login moze składać się tylko z liter i cyfr (bez polskich znaków)";
        }

        //Sprawdz poprawnosc adresu email
        $email = $_POST['email'];
        $emailB = filter_var($email, FILTER_SANITIZE_EMAIL);

        if((filter_var($emailB, FILTER_VALIDATE_EMAIL)==false) || ($emailB != $email))
        {
            $everything_good = false;
            $_SESSION['e_emial'] = "podaj poprawny adres email";
        }


        //Sprawdz hasła

        $pass1 = $_POST['password1'];
        $pass2 = $_POST['password2'];

        if(strlen($pass1)<4 || strlen($pass1)>20)
        {
            $everything_good = false;
            $_SESSION['e_password'] = "Hasło musi składać sie od 8 do 20 znaków";
        }

        if($pass1 != $pass2)
        {
            $everything_good = false;
            $_SESSION['e_password'] = "Hasła się nie zgadzają";
        }

        $pass_hash = password_hash($pass1, PASSWORD_DEFAULT);


        /*sprawdzenie regulaminu i zaznaczenie checkbox */


        //Sprawdzenie chapta 
        $skey = "6LeXE-8UAAAAAJvjugUyuWVP4IfKT_A4GBMRCb7A";

        $check_Captcha = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$skey.'&response='.$_POST['g-recaptcha-response']);

        $capchta_answer = json_decode($check_Captcha);

        if($capchta_answer->success==false)
        {
            $everything_good = false;
            $_SESSION['e_bot'] = "Potwierdź ze nie jestes botem";
        }

        //laczenie z baza danych
        require_once "connect.php"; //dane do polaczenia w pliku
        mysqli_report(MYSQLI_REPORT_STRICT);

        try
        {
            $connect = new mysqli($host, $db_user, $db_password, $db_name );
            if($connect->connect_errno!=0)
            {
                throw new Exception(mysqli_connect_errno());
            }
            else {
                //czy email juz istnieje
                $result = $connect->query("SELECT id FROM users WHERE email ='$email'");
                if(!$result) throw new Exception($connect->error);

                $ile_takich_meili = $result->num_rows;
                if($ile_takich_meili > 0)
                {
                    $everything_good = false;
                    $_SESSION['e_email'] = "Istnieje juz konto przypisane do tego adresu email";
                }

                //czy login juz istnieje
                $result = $connect->query("SELECT id FROM users WHERE username ='$login'");
                if(!$result) throw new Exception($connect->error);
 
                 $ile_takich_login = $result->num_rows;
                 if($ile_takich_login > 0)
                {
                    $everything_good = false;
                    $_SESSION['e_login'] = "Login jest zajęty";
                }
                if($everything_good == true)
                {
                  if($connect->query("INSERT INTO users VALUES(NULL, '$login', '$pass_hash', '$email')"))
                  {
                    $_SESSION['udana_rejestracja']= true;
                    header('Location: hello.php');
                  }
                  else{
                    throw new Exception($connect->error);
                  }
                  /////
                    $result = $connect->query("SELECT id FROM users WHERE username = '$login'");
                    if ($result->num_rows > 0)
                    {
                        $row = $result->fetch_assoc();
                        $userid = $row['id'];
                        
                    }else 
                    {
                         throw new Exception($connect->error);
                    }

                    $result = $connect->query("SELECT name FROM expenses_category_default");
                    if ($result->num_rows > 0) 
                    {
                         // output data of each row
                         
                        while($row = $result->fetch_assoc()) {
                        $namecategory = $row["name"]; //wyciagniecie nazwy kategorii;

                        $connect->query("INSERT INTO expenses_category_assigned_to_users 
                        VALUES (NULL, $userid , '$namecategory')");
                       
                        }
                    }else 
                    {
                         throw new Exception($connect->error);
                    }
                    
                    $result = $connect->query("SELECT name FROM incomes_category_default ");
                    if ($result->num_rows > 0) 
                    {
                         // output data of each row
                         
                        while($row = $result->fetch_assoc()) {
                        $namecategory = $row["name"]; //wyciagniecie nazwy kategorii;

                        $connect->query("INSERT INTO incomes_category_assigned_to_users 
                        VALUES (NULL, $userid , '$namecategory')");
                        }
                    }else 
                    {
                         throw new Exception($connect->error);
                    }
                    
                }
                $connect ->close();
            }
        }
        catch(Exception $e)
        {
            echo 'Błąd serwera, spróbuj puźniej';
            //echo '</br>info deweloperskie '.$e;
        }
    }


?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Moje Finanse - rejestracja</title>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>    
    <!-- Styles -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/fontello.css">
    <link rel="stylesheet" href="style.css">
    <!--Fonts-->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">

    <style>
 
    </style>
</head>
<body>
    <header>
        <nav class="navbar_top">
            <a href="index.php" class="navbar-brand"><i class="icon-wallet d-inline-block align-bottom"></i>Moje Finanse</a>
        </nav>  
    </header>
    <main>
        <section class="wrapper">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class = "register_panel">

                            <form method="POST">

                                <div class="icon-adult">Login</div>
                                <input type="text"  name="login" placeholder="login.."/>

                                    <?php
                                        if(isset($_SESSION['e_login'])){
                                            echo '<div class="error">'.$_SESSION['e_login'].'</div>';
                                            unset($_SESSION['e_login']);
                                        }
                                    ?>

                                <div class="icon-mail-alt">Email</div> 
                                <input type="email"  name="email" placeholder="@.."/>

                                    <?php
                                        if(isset($_SESSION['e_email'])){
                                            echo '<div class="error">'.$_SESSION['e_email'].'</div>';
                                            unset($_SESSION['e_email']);
                                        }
                                    ?>
                            
                                <div class ="icon-key">Hasło</div> 
                                <input type="password"  name="password1" placeholder="hasło.."/>

                                <div class ="icon-key">Powtórz hasło</div> 
                                <input type="password"  name="password2" placeholder="powtórz hasło.."/>

                                    <?php
                                        if(isset($_SESSION['e_password'])){
                                            echo '<div class="error">'.$_SESSION['e_password'].'</div>';
                                            unset($_SESSION['e_password']);
                                        }
                                    ?>

                                <div class="g-recaptcha" data-sitekey="6LeXE-8UAAAAAIfwIS7jNn4aeKAJa7p_QwlvlMsJ"></div>
                                    <?php
                                        if(isset($_SESSION['e_bot'])){
                                            echo '<div class="error">'.$_SESSION['e_bot'].'</div>';
                                            unset($_SESSION['e_bot']);
                                        }
                                    ?>

                                <input type="submit" value="Zarejestruj">

                                
                            </form>

                        </div>
                    </div>

                </div>
            </div>
        </section>
    </main>
    <footer>
        <p>Copyight &copy; 2020 - Krystian Lewandowski</p> 
    </footer>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>


