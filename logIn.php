<?php 

session_start();    

if((!isset($_POST['login']))||(!isset($_POST['pass'])))
{
    header('Location: index.php');
    exit();
}

require_once "connect.php"; //dane do polaczenia w pliku
mysqli_report(MYSQLI_REPORT_STRICT);

try{
    $connect = new mysqli($host, $db_user, $db_password, $db_name );
    if($connect->connect_errno!=0)
    {
        throw new Exception(mysqli_connect_errno());
    } else 
    {

        $log = $_POST['login'];
        $password = $_POST['pass'];
        
        $log = htmlentities($log, ENT_QUOTES, "UTF-8");
        
        if($result = @$connect->query(sprintf("SELECT * FROM users WHERE username ='%s'", 
        mysqli_real_escape_string($connect, $log)))) 
        {
            /* wyciagamy wartosci z tabeli jesli polaczenie sie udalo */
            $user_connect = $result->num_rows;
            if($user_connect > 0)
            {
                $row = $result->fetch_assoc(); /*Pobiebra z bazy danych dane z kazdej kolumny i wstawia do tabeli asociacyjnej*/
                if(password_verify($password, $row['pass'])) //sprawdzanie haszu hasla wporowadzonego z haszem w bazie
                {
                    /*Jesli jest uzytkownik w bazie*/
                    $_SESSION['zalogowany'] = true;
    
                    //przysylanie w sesji wartosci pomiedzy dokumentami
    
                    //wyciagamy id z bazy danych i wstawiamy do tablicy asociacyjnej i mozemy tak dalej wyciagac;
                    $_SESSION['id'] = $row ['id']; //pobieranie id uzytkownika !!
    
                    unset($_SESSION['blad']); //usuwanie z sesji zmiennej blad;
                    $result->close(); //pozbywamy sie z pamieci ram niepotrzebnych juz rezultatow zapytania;
                    header('Location: home.php'); // przekierowanie do strony po zalogowaniu;
                }
                else{
                      /*Jeśli hasz hasla sie nie zgadza*/
                $_SESSION['blad'] = '<span style="color: red">Niepoprawny login lub hasło !</span>';
                header('Location: index.php');
                }
            }
            else{
                /*Jeśli nie ma uzytkownika w bazie*/
                $_SESSION['blad'] = '<span style="color: red">Niepoprawny login lub hasło !</span>';
                header('Location: index.php');
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

?>

