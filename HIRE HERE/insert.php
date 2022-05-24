<?php
$oname = $_POST['oname'];
$ename = $_POST['ename'];
$Eventype = $_POST['Eventtype'];
$Date = $_POST['Date'];
$Place = $_POST['Place'];

if(!empty($oname) || !empty($ename) || !empty($Eventype) || !empty($Date) || !empty($Place)){

    $host = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbname = "form1";

    // create connection
    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);

    if (mysqli_connect_error()){

        die('Connect Error('. mysqli_connect_errno().')' . mysqli_connect_error());
    }else{

        $SELECT = "SELECT Place Frpm form1 Where Place = ?Limit 1";
        $INSERT = "INSERT Into register (oname, ename, Eventtype, Date, Place) values(?, ?, ?, ?, ?)";

        //Prepare Statement
        $stmt= $conn->prepare($SELECT);
        $stmt->bind_param("s", $Place);
        $stmt->execute();
        $stmt->bind_result($Place);
        $stmt->store_result();
        $rnum = $stmt->num_rows();

        if ($num==0) {
             
            $stmt->close();

            $stmt = $conn->prepare($INSERT);
            $stmt->bind_param("sssss" , $oname, $ename, $Eventype, $Date, $Place);
            $stmt->execute();
            echo "New record inserted Successfully";

        }else{
            echo "Already Used";
        }

        $stmt->close();
        $conn->close();
    }

}else{

    echo "All field are Required";
    die();
}





?>