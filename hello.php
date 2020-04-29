<?php
    session_start();
    if(!isset($_SESSION['udana_rejestracja'])) 
    {
        header ('Location: index.php');
        exit();
    }
    else {
        unset($_SESSION['udana_rejestracja']);
    }
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Moje Finanse</title>
    <!-- Styles -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/fontello.css">
    <link rel="stylesheet" href="style.css">
    <!--Fonts-->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">

</head>
<body>
    <header>
        <nav class="navbar_top">
            <a href="#" class="navbar-brand"><i class="icon-wallet d-inline-block align-bottom"></i>Moje Finanse</a>
        </nav> 
    </header>
    <main>
        <section class="wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <section class="hello_panel"> 
                            
                                <div class="discripton">
                                    <h1>Dziękujemy za rejestracje w serwisie</h1>
                                    <p>Możesz juz zalogować się na swoje konto</p> 
                                </div>

                                <div class = "log_panel">
                        
                            <form action="logIn.php" method="POST">
                                <div class="icon-adult">Login</div>
                                <input type="text"  name="login" placeholder="login..">
                            
                               <div class ="icon-key">Hasło</div> 
                                <input type="password" name="pass" placeholder="hasło..">
                            
                                <input type="submit" value="Zaloguj">
                                </form>
                               <?php
                                if(isset($_SESSION['blad']))
                                echo $_SESSION['blad'];
                                ?> 
                                
                            </div>
                            
                        </section>
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