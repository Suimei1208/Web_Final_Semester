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
        $sql = "SELECT * FROM films ORDER BY id ASC;";
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
    function showFlims_des(){
        $conn = connect();
        $sql = "SELECT * FROM films ORDER BY id DESC";
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
            $randNum = rand(1, 19);
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
    function getFlims_Genre_advan($selected_genres, $search_term = '') {
        $conn = connect();
        $query = "SELECT * FROM films";
        $where = [];
        $params = [];
    
        $genres = [];
        foreach ($selected_genres as $genre) {
            if (!empty($genre)) {
                $genres[] = $genre;
            }
        }
    
        if (!empty($genres)) {
            $genre_keys = array_fill_keys($genres, true);
            $genre_count = count($genres);
            $genre_conditions = array_fill(0, $genre_count, 'genre LIKE ?');
            $where[] = '(' . implode(' AND ', $genre_conditions) . ')';
            $params = array_map(function($genre) {
                return "%$genre%";
            }, $genres);

        }
        if (empty($params)) {
            $conn->close();
            return false;
        }
    
        if (!empty($search_term)) {
            $where[] = "name_flim LIKE ?";
            $params[] = "%$search_term%";
        }
    
        if (!empty($where)) {
            $query .= ' WHERE ' . implode(' AND ', $where);
        }
    
        $stmt = mysqli_prepare($conn, $query);
        if ($stmt) {
            $types = str_repeat('s', count($params));
            $stmt->bind_param($types, ...$params);
            $stmt->execute();
            $result = $stmt->get_result();
            if(mysqli_num_rows($result) > 0) {
                $items = [];
                while($row = mysqli_fetch_assoc($result)) {
                    $items[] = $row;
                }
                $conn->close();
                return $items;
            } else {
                $conn->close();
                return false;
            }
        } else {
            echo "Lỗi: " . mysqli_error($conn);
        }
        $stmt->close();
    }
    function update_view($name_films){
        $conn = connect();
        $stmt = $conn->prepare("UPDATE films SET view = view + 1 WHERE name_flim = ? ");
        $stmt->bind_param("s", $name_films);
        $success = $stmt->execute();
        $conn->close();
        return $success;
    }    
    function update_avatar($avatar, $username){
        $conn = connect();
        $stmt = $conn->prepare("UPDATE account SET avatar= ? WHERE UserName = ?");
        $stmt->bind_param("ss", $avatar, $username);
        $success = $stmt->execute();
        $conn->close();
        return $success;
    }  
    function get_film($name){
        $conn = connect();
        $stmt = $conn->prepare("SELECT * FROM films WHERE name_flim = ?");
        $stmt->bind_param("s", $name);
        $stmt->execute();
        $result = $stmt->get_result();
        $films = array();
        while ($row = $result->fetch_assoc()) {
            $films[] = $row;
        }
        $stmt->close();
        $conn->close();
        return $films;
    }
    function get_avatar($name){
        $conn = connect();
        $stmt = $conn->prepare("SELECT * FROM account WHERE UserName = ?");
        $stmt->bind_param("s", $name);
        $stmt->execute();
        $result = $stmt->get_result();
        $films = array();
        while ($row = $result->fetch_assoc()) {
            $films[] = $row;
        }
        $stmt->close();
        $conn->close();
        return $films;
    }
    function get_fa_film($username){
        $conn = connect();
        $sql = "SELECT f.* FROM films f INNER JOIN library l ON f.name_flim = l.flims_name WHERE l.username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if($result->num_rows > 0){
            $items = [];
            while($row = $result->fetch_assoc()){
                $items[] = $row;
            }
            $stmt->close();
            $conn->close();
            return $items;
        }else{
            $stmt->close();
            $conn->close();
            return false;
        }
    }
    function get_rate_username($username, $flims) {
        $conn = connect();
        $stmt = $conn->prepare("SELECT rate FROM rate WHERE userName = ? AND name_flim = ?");
        $stmt->bind_param("ss", $username, $flims);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $stmt->close();
            $conn->close();
            return true;
        } else {
            $stmt->close();
            $conn->close();
            return false;
        }
    }
    
    
    function get_rate_by_film($film) {
        $conn = connect();
        $stmt = $conn->prepare("SELECT rate FROM films WHERE name_flim = ?");
        $stmt->bind_param("s", $film);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $rate = $row['rate'];
            
            $stmt->close();
            $conn->close();
            return $rate; 
        } else {
            $stmt->close();
            $conn->close();
            return false; 
        }
    }
    function insert_rate($username, $name_films, $rate){
        $conn = connect();
        $stmt = $conn->prepare("INSERT INTO rate (username, name_flim, rate) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $name_films, $rate);
        $success = $stmt->execute();
        $stmt->close();
        $conn->close();
        return $success;
    }   
    
    function update_rates($rate, $username, $film){
        $conn = connect();
        $stmt = $conn->prepare("UPDATE rate SET rate = ? WHERE name_flim = ? AND username = ?");
        $stmt->bind_param("sss", $rate , $film, $username);
        $success = $stmt->execute();
        $stmt->close();
        $conn->close();
        return $success;
    }
    
    function update_rate_all_flims() {
        $conn = connect();
        $sql = "UPDATE films f
                JOIN (
                    SELECT name_flim, AVG(rate) AS avg_rate
                    FROM rate
                    GROUP BY name_flim
                ) r ON f.name_flim = r.name_flim
                SET f.rate = avg_rate";
        $stmt = $conn->prepare($sql);
        $result = $stmt->execute();
        $stmt->close();
        $conn->close();
        return $result;
    }
    
    
    function count_rate_users($name_flim) {
        $conn = connect();
        $sql = "SELECT COUNT(DISTINCT username) AS count_users
                FROM rate
                WHERE name_flim = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $name_flim);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $count_users = $row['count_users'];
        } else {
            $count_users = 0;
        }
        $stmt->close();
        $conn->close();  
        return $count_users;
    }
    
    function get_type($type){
        $conn = connect();
        $stmt = $conn->prepare("SELECT f.* FROM films f JOIN video v ON f.name_flim = v.name_flim WHERE v.type = ?");
        $stmt->bind_param("s", $type);
        $stmt->execute();
        $result = $stmt->get_result();
        $films = array();
        while ($row = $result->fetch_assoc()) {
            $films[] = $row;
        }
        $stmt->close();
        $conn->close();
        return $films;
    }
    function select_tr_ep($name){
        $conn = connect();
        $stmt = $conn->prepare("SELECT trailer, Episodes FROM video WHERE name_flim = ?");
        $stmt->bind_param("s", $name);
        $stmt->execute();
        $result = $stmt->get_result();
        $films = array();
        while ($row = $result->fetch_assoc()) {
            $films[] = $row;
        }
        $stmt->close();
        $conn->close();
        return $films;
    }
?>