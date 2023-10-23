<?php
$con = mysqli_connect("localhost", "root", "", "booking_db");
if (mysqli_connect_errno()){
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    die();
}



function spojiSeNaBazu(){
    $veza = mysqli_connect("localhost", "root", "", "booking_db");

    
    if(!$veza){
        echo "GREŠKA: 
        Problem sa spajanjem u datoteci baza.php funkcija otvoriVezu:  
        ".mysqli_connect_error();
    }
    
    
    
    mysqli_select_db($veza,'booking_db');
    
    if(mysqli_error($veza)!==""){
        echo "GREŠKA: 
        Problem sa odabirom baze u baza.php funkcija otvoriVezu:  
        ".mysqli_error($veza);
    }
    
    mysqli_set_charset($veza,"utf8");
    
    if(mysqli_error($veza)!==""){
        echo "GREŠKA: 
        Problem sa odabirom baze u baza.php funkcija otvoriVezu:  
        ".mysqli_error($veza);
    }
    
    return $veza;
}

function izvrsiUpit($veza, $upit){
    
    $rezultat = mysqli_query($veza,$upit);
    
    if(mysqli_error($veza)!==""){
        echo "GREŠKA: 
        Problem sa upitom: ".$upit." : u datoteci baza.php funkcija izvrsiUput:  
        ".mysqli_error($veza);
    }
    
    return $rezultat;
}

function zatvoriVezuNaBazu($veza){
    mysqli_close($veza);
}   

?>
?>