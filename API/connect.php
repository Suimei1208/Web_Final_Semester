<?php 
    function connect(){
        $host = "localhost:3306";
        $user = "root";
        $passwd = "";
        $db = "webfinal";
        return $conn = new mysqli($host, $user, $passwd, $db);
    }
    function showFlims(){
        $conn = connect();
        $sql = "SELECT * FROM films";
        $result = mysqli_query($conn, $sql);

        if(mysqli_num_rows($result)>0){
            $items = [];
            while($row = mysqli_fetch_assoc($result)){
                $items[] = $row;
            }
            $conn->close();
            return $items;
        }else{
            $conn->close();
            return false;
        }
    }
    function generateRandomNumbers() {
        $numbers = array();
        while (count($numbers) < 5) {
            $randNum = rand(1, 13);
            if (!in_array($randNum, $numbers)) {
                $numbers[] = $randNum;
            }
        }
        return $numbers;
    }
    
    function showFilmsRand($numbers) {
        $conn = connect();
        $items = [];
        foreach ($numbers as $number) {
            $sql = "SELECT * FROM films where id = $number";
            $result = mysqli_query($conn, $sql);
    
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $items[] = $row;
                }
            }
        }
        $conn->close();
        return $items;
    }
    
    function getGenres(){
        $conn = connect();
        $sql = "SELECT * FROM genres";
        $result = mysqli_query($conn, $sql);

        if(mysqli_num_rows($result)>0){
            $items = [];
            while($row = mysqli_fetch_assoc($result)){
                $items[] = $row;
            }
            $conn->close();
            return $items;
        }else{
            
            return false;
        }
    }
    function getFlims($name){
        $conn = connect();
        $genre = "%$name%";
        $stmt = $conn->prepare("SELECT * FROM films WHERE name_flim LIKE ? ");
        $stmt->bind_param("s", $genre);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if(mysqli_num_rows($result)>0){
            $items = [];
            while($row = mysqli_fetch_assoc($result)){
                $items[] = $row;
            }
            $conn->close();
            return $items;
        }else{
            $conn->close();
            return false;
        }
    }
    function getFlims_Genre($name){
        $conn = connect();
        $genre = "%$name%";
        $stmt = $conn->prepare("SELECT * FROM films WHERE genre LIKE ? ");
        $stmt->bind_param("s", $genre);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if(mysqli_num_rows($result)>0){
            $items = [];
            while($row = mysqli_fetch_assoc($result)){
                $items[] = $row;
            }
            $conn->close();
            return $items;
        }else{
            $conn->close();
            return false;
        }   
    }
?>