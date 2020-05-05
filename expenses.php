<?php
    session_start();
    if(!isset($_SESSION['zalogowany']))
    {
        header('Location: index.php');
        exit();
    }

    function getDateForDatabase(string $date): string {
        $timestamp = strtotime($date);
        $date_formated = date('Y-m-d H:i:s', $timestamp);
        return $date_formated;
    }

    if(isset($_POST['amount']))
    {
        //Udana walidacja tak
        $everything_good = true;


        //sprawdzanie poprawnosci kwoty
        $amount = $_POST['amount'];
        $amount = str_replace(",",".",$amount); //zamiana przecinka na kropke;
        if(!is_numeric($amount))
        {
            $everything_good = false;
            $_SESSION['e_amount']= "Podaj kwotę";
        }
        
        //sprawdzenie daty
        $data = $_POST['date'];
        
        if($data == '') //jesli nie ma daty to wstawiamy dzisiejsza z systemu
        {
            $data = new DateTime();
            $data = $data->format('Y-m-d');
        }

        if(strlen($data) < 10)
        {
            $everything_good = false;
            $_SESSION['e_data']= "Nie prawidłowy format daty: yyyy-mm-dd";
        }
       
        $year = substr($data, 0, 4);
        $month = substr($data, 5,2);
        $day = substr($data, 8,2); 

        if(!checkdate($month, $day, $year))
        {
            $everything_good = false;
            $_SESSION['e_data']= "Nie prawidłowy format daty: yyyy-mm-dd";
        }
        
        $data = getDateForDatabase($data);
        

        //swybor kategorii
        $category = $_POST['category'];

        // pobranie komentarza
        $comment = $_POST['comment'];

        require_once "connect.php"; //dane do polaczenia w pliku
        mysqli_report(MYSQLI_REPORT_STRICT);

        try
        {
            $connect = new mysqli($host, $db_user, $db_password, $db_name );
            if($connect->connect_errno!=0)
            {
                throw new Exception(mysqli_connect_errno());
            }
            else 
            {
                if($everything_good == true)
                {
                    $userid = $_SESSION['id'];
                    $result = $connect->query("SELECT id FROM expenses_category_assigned_to_users 
                    WHERE user_id = '$userid' AND name = '$category'");
                    if ($result->num_rows > 0) 
                    {
                         // output data of each row
                         
                        while($row = $result->fetch_assoc()) {
                        $category_id = $row["id"]; //wyciagniecie id kategorii;
                        }
                    }
                   
                    if($connect->query("INSERT INTO expenses VALUES(NULL, '$userid', '$category_id', '$amount', '$data', '$comment')"))
                    {
                        $_SESSION['good'] = true;
                        header('Location: home.php'); 
                    }
                    else
                    {
                        throw new Exception($connect->error);
                    }
                }
                    
            }
            $connect ->close();
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

    <title>Moje Finanse</title>
    <!-- Styles -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/fontello.css">
    <link rel="stylesheet" href="style.css">
    <!--Fonts-->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
    
    <!-- input data-->
    <script type="text/javascript">
    var datefield=document.createElement("input")
    datefield.setAttribute("type", "date")
    if (datefield.type!="date"){ //if browser doesn't support input type="date", load files for jQuery UI Date Picker
        document.write('<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css" />\n')
        document.write('<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"><\/script>\n')
        document.write('<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"><\/script>\n') 
    }
    </script>
 
    <script>
    if (datefield.type!="date"){ //if browser doesn't support input type="date", initialize date picker widget:
    jQuery(function($){ //on document.ready
        $('#birthday').datepicker();
    })
    }
    </script>
    <!-- end script-->
</head>
<body>
    <header>
            <nav class="navbar_top  navbar-expand-md">
                <a href="index.php" class="navbar-brand"><i class="icon-wallet d-inline-block align-bottom"></i>Moje Finanse</a>
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
                        <a href="home.php" class="nav-link"><i class="icon-home"></i>Twoje finanse</a>
                    </li>
                    <li class="nav-item">
                        <a href="income.php" class="nav-link"><i class="icon-plus"></i>Przychód</a>
                    </li>
                    <li class="nav-item">
                        <a href="expenses.php" class="nav-link"><i class="icon-minus"></i>Wydatek</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link"><i class="icon-chart-pie-alt"></i>Przegladaj bilans</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link"><i class="icon-user"></i>Ustawienia</a>
                    </li>
                    <li class="nav-item">
                        <a href="logOut.php" class="nav-link"><i class="icon-login"></i>Wyloguj</a>
                    </li>
                </ul>
            </div>
        </nav> 
        <section class="main_panel ">
            
            <div class="manage_panel">
                <div class="heading"><i class="icon-minus"></i>Wydatek</div>
                <form action="#.php">

                     Kwota:
                    <input type="text" name="amount" placeholder="kwota..">

                     Data: 
                    <input type="date"  name="date" placeholder="yyyy-mm-dd">
                    <input type="date" name="date" placeholder = "yyyy-mm-dd">
                        <?php
                            if(isset($_SESSION['e_data'])){
                                echo '<div class="error">'.$_SESSION['e_data'].'</div>';
                                unset($_SESSION['e_data']);
                            }
                        ?>
                    
                    Wybierz kategorie: 
                    <select name="category">
                        <option value = "Transport" name ="Transport">Transport</option>
                        <option name = "Książki">Książki</option>
                        <option name = "Jedzenie">Jedzenie</option>
                        <option name = "Czynsz">Czynsz</option>
                        <option name = "Media"> Media</option>
                        <option name = "Zdrowie"> Zdrowie</option>
                        <option name = "Ubrania"> Ubrania</option>
                        <option name = "Higiena"> Higiena </option>
                        <option name = "Dzieci"> Dzieci</option>
                        <option name = "Wycieczka"> Wycieczka</option>
                        <option name = "Recepty">Recepty</option>
                        <option name = "Podróż">Podróż</option>
                        <option name = "Prezenty">Prezenty</option>
                        <option name = "Inne">Inne</option>
                    </select>

                    Komentarz: 
                    <input type="text" name="comment" placeholder="komentarz..">
                    
                    <div style="display: flex; margin-top: 30px;">
                        <input type="submit" value="Dodaj" style="width: 100%;">
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
