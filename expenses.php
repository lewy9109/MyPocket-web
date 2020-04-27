<?php
    session_start();
    if(!isset($_SESSION['zalogowany']))
    {
        header('Location: index.php');
        exit();
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
            <nav class="navbar_top  navbar-expand-md">
                <a href="#" class="navbar-brand"><i class="icon-wallet d-inline-block align-bottom"></i>Moje Finanse</a>
            </nav>   
    </header>
    <main>
        <nav class="navbar  navbar-expand-md">
            <button type="button" class="navbar-toggler hamburger" data-toggle="collapse" data-target="#mainmenu" aria-controls="mainmenu" aria-expanded="false" aria-label="Przełącznik nawigacji">
                <span class="icon-th-list"></span>
            </button>

            <div class="collapse navbar-collapse" id="mainmenu">
                <ul class= "navbar-nav">
                    <li class="nav-item">
                        <a href="home.html" class="nav-link"><i class="icon-home"></i>Twoje finanse</a>
                    </li>
                    <li class="nav-item">
                        <a href="income.html" class="nav-link"><i class="icon-plus"></i>Przychód</a>
                    </li>
                    <li class="nav-item">
                        <a href="expenses.html" class="nav-link"><i class="icon-minus"></i>Wydatek</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link"><i class="icon-chart-pie-alt"></i>Przegladaj bilans</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link"><i class="icon-user"></i>Ustawienia</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link"><i class="icon-login"></i>Wyloguj</a>
                    </li>
                </ul>
            </div>
        </nav> 
        <section class="main_panel ">
            
            <div class="manage_panel">
                <div class="heading"><i class="icon-minus"></i>Wydatek</div>
                <form action="#.php">

                    <label for="name"> Kwota: </label>
                    <input type="text" id="name" name="name" placeholder="kwota..">

                    <label for="date"> Data: </label>
                    <input type="date" id="date" name="date" >
                    
                    <label for="date">Wybierz kategorie: </label>
                    <select name="lista">
                        <option value = "Praca">Jedzenie</option>
                        <option value="Opcja 2">Mieszkanie</option>
                        <option>Transport</option>
                        <option>Telekomunikacja</option>
                        <option value=""> Opieka zdrowotna</option>
                        <option value=""> Ubranie</option>
                        <option value=""> Higiena</option>
                        <option value=""> Dzieci </option>
                        <option value=""> Rozrywka</option>
                        <option value=""> Wycieczka</option>
                        <option value="">Szkolenia</option>
                        <option value="">Książki</option>
                        <option value="">Oszczędności</option>
                        <option value="">Na złotą jesień, czyli emeryturę</option>
                        <option value="">Spłata długów</option>
                        <option value="">Darowizna</option>
                        <option value="">Inne wydatki</option>
                    </select>

                    <label for="comment"> Komentarz: </label>
                    <input type="text" id="comment" name="comment" placeholder="komentarz..">
                    
                    <div style="display: flex; margin-top: 30px;">
                        <input type="submit" value="Dodaj" style="width: 40%; margin-right: 5%; margin-left: 10%;">
                        <input type="submit" value="Anuluj" style="width: 40%; margin-left: 5%; margin-right: 10%;">
                    </div>
                    
                </form>
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
