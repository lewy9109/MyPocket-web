<?php 

session_start();    

if((!isset($_POST['login']))|| (!isset($_POST['pass'])))
{
    header('Location: index.php');
    exit();
}

require_once "connect.php"; //dodanie polaczenia;

$connect = @new mysqli($host, $db_user, $db_password, $db_name );

if($connect->connect_errno!=0)
{
    echo "Error: ".$connect->connect_errno;
}
else
{
    $log = $_POST['login'];
    $password = $_POST['pass'];

    $log = htmlentities($login, ENT_QUOTES, "UTF-8");
    $password = htmlentities($password, ENT_QUOTES, "UTF-8");


    //$sql = "SELECT * FROM users WHERE login ='$log' AND pass ='$password'";
    if($result = @$connect->query(sprintf("SELECT * FROM users WHERE login ='%s' AND pass ='%s'", 
    mysqli_real_escape_string($connect, $log),
    mysqli_real_escape_string($connect, $password)
    ))) 
    {
        /* wyciagamy wartosci z tabeli jesli polaczenie sie udalo */
        $user_connect = $result->num_rows;
        if($user_connect > 0)
        {

            /*Jesli jest uzytkownik w bazie*/
            $_SESSION['zalogowany'] = true;
            $row = $result->fetch_assoc(); /*Pobiebra z bazy danych dane z kazdej kolumny i wstawia do tabeli asociacyjnej*/
             /* $imie = $row['name']; wyciagamy imie z bazy danych i wstawiamy do tablicy asociacyjnej i mozemy tak dalej wyciagac;*/
            
            //przysylanie w sesji wartosci pomiedzy dokumentami
            $_SESSION ['imie']= $row['name']; //wyciagamy imie z bazy danych i wstawiamy do tablicy asociacyjnej i mozemy tak dalej wyciagac;
            $_SESSION['id'] = $row ['id']; //pobieranie id uzytkownika !!


            unset($_SESSION['blad']); //usuwanie z sesji zmiennej blad;
            $result->close(); //pozbywamy sie z pamieci ram niepotrzebnych juz rezultatow zapytania;
            header('Location: home.php'); // przekierowanie do strony po zalogowaniu;
        }
        else{
            /*Jeśli nie ma uzytkownika w bazie*/
            $_SESSION['blad'] = '<span style="color: red">Niepoprawny login lub hasło !</span>';
            header('Location: index.php');
        }

    }
    $connect->close();
}

?>

