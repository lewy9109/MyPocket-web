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
                <a href="index.php" class="navbar-brand"><i class="icon-wallet d-inline-block align-bottom"></i>Moje Finanse</a>
            </nav>   
    </header>
    <main>
        <nav class="navbar  navbar-expand-md">

            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#mainmenu" aria-controls="mainmenu" aria-expanded="false" aria-label="Przełącznik nawigacji">
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
                    <li class="nav-item dropdown">
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

            <div class="pick_date">
                <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
               <i class="icon-calendar"></i> Wybierz okres
            </button>
            
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Wybierz Okres</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        <label for="date"> Od kiedy: </label>
                    <input type="date" id="date" name="date" >
                    <label for="date"> Do kiedy: </label>
                    <input type="date" id="date" name="date" >
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Zamknij</button>
                    <button type="button" class="btn btn-primary">Zapisz zmiany</button>
                    </div>
                </div>
                </div>
            </div>

            </div>
            




            <div class="heading"><i class="icon-th-list"></i>Bilans</div>
            <div class="bilans_panel ">
                <div class="income_box "><div class="income_item">Praca</div><span> - </span><div class="income_item">10.02.2020</div><span> - </span><div class="income_item">3000</div></div>
                <div class="expense_box "><div class="income_item">Czynsz</div><span> - </span><div class="income_item">11.02.2020</div><span> - </span><div class="income_item">500</div></div>
                <div class="income_box "><div class="income_item">Praca</div><span> - </span><div class="income_item">10.02.2020</div><span> - </span><div class="income_item">3000</div></div>
                <div class="expense_box "><div class="income_item">Czynsz</div><span> - </span><div class="income_item">11.02.2020</div><span> - </span><div class="income_item">500</div></div>
                <div class="income_box "><div class="income_item">Praca</div><span> - </span><div class="income_item">10.02.2020</div><span> - </span><div class="income_item">3000</div></div>
                <div class="expense_box "><div class="income_item">Czynsz</div><span> - </span><div class="income_item">11.02.2020</div><span> - </span><div class="income_item">500</div></div>
                <div class="income_box "><div class="income_item">Praca</div><span> - </span><div class="income_item">10.02.2020</div><span> - </span><div class="income_item">3000</div></div>
                <div class="expense_box "><div class="income_item">Czynsz</div><span> - </span><div class="income_item">11.02.2020</div><span> - </span><div class="income_item">500</div></div>
                <div class="income_box "><div class="income_item">Praca</div><span> - </span><div class="income_item">10.02.2020</div><span> - </span><div class="income_item">3000</div></div>
                <div class="expense_box "><div class="income_item">Czynsz</div><span> - </span><div class="income_item">11.02.2020</div><span> - </span><div class="income_item">500</div></div>
            </div>
        </br>
            <div class="heading"><i class="icon-chart-pie-alt"></i>Bilans kołowy</div>

            <div id="piechart"></div>

            <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

            <script type="text/javascript">
            // Load google charts
            google.charts.load('current', {'packages':['corechart']});
            google.charts.setOnLoadCallback(drawChart);

            // Draw the chart and set the chart values
            function drawChart() {
            var data = google.visualization.arrayToDataTable([
            ['Praca', 'Hours per Day'],
            ['Zarobki', 8],
            ['Wydatki', 2]
            ]);

            // Optional; add a title and set the width and height of the chart
            var options = {'title':'Moje Finanse', 'width':550, 'height':400};

            // Display the chart inside the <div> element with id="piechart"
            var chart = new google.visualization.PieChart(document.getElementById('piechart'));
            chart.draw(data, options);
            }
            </script>

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