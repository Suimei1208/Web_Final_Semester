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

    // function getFlims_Genre_advan($selected_genres, $search_term = '') {
    //     $conn = connect();
    //     $query = "SELECT * FROM films WHERE ";
    //     $genre_count = count($selected_genres);
    //     for ($i=0; $i<$genre_count; $i++) {
    //         $query .= "genre LIKE ? ";
    //         if ($i < $genre_count - 1) {
    //             $query .= "OR ";
    //         }
    //     }
    //     if (!empty($search_term)) {
    //         $query .= "AND name_flim LIKE ?";
    //     }
    //     $stmt = mysqli_prepare($conn, $query);
    //     if ($stmt) {
    //         $types = str_repeat('s', $genre_count);
    //         if (!empty($search_term)) {
    //             $types .= "s";
    //         }
    //         $params = array_map(function($genre) {
    //             return "%$genre%";
    //         }, $selected_genres);
    //         if (!empty($search_term)) {
    //             array_push($params, "%$search_term%");
    //         }
    //         $stmt->bind_param($types, ...$params);
    //         $stmt->execute();
    //         $result = $stmt->get_result();
    //         if(mysqli_num_rows($result) > 0) {
    //             $items = [];
    //             while($row = mysqli_fetch_assoc($result)) {
    //                 $items[] = $row;
    //             }
    //             $conn->close();
    //             return $items;
    //         } else {
    //             $conn->close();
    //             return false;
    //         }
    //     } else {
    //         echo "Lỗi: " . mysqli_error($conn);
    //     }
    //     $stmt->close();
    // }  
    // function getFlims_Genre_advan($selected_genres, $search_term = '') {
    //     $conn = connect();
    //     $query = "SELECT * FROM films";
    //     $where = [];
    //     $params = [];
    
    //     if (!empty($selected_genres)) {
    //         $genre_keys = array_fill_keys($selected_genres, true);
    
    //         $genre_count = count($selected_genres);
    //         $genre_conditions = array_fill(0, $genre_count, 'genre LIKE ?');
    //         $where[] = '(' . implode(' OR ', $genre_conditions) . ')';
    
    //         $params = array_keys($genre_keys);
    //         $params = array_map(function($genre) {
    //             return "%$genre%";
    //         }, $params);
    //     }
    
    //     if (!empty($search_term)) {
    //         $where[] = "name_flim LIKE ?";
    //         $params[] = "%$search_term%";
    //     }

    //     if (!empty($where)) {
    //         $query .= ' WHERE ' . implode(' AND ', $where);
    //     }
    
    //     $stmt = mysqli_prepare($conn, $query);
    //     if ($stmt) {
    //         $types = str_repeat('s', count($params));
    //         $stmt->bind_param($types, ...$params);
    //         $stmt->execute();
    //         $result = $stmt->get_result();
    //         if(mysqli_num_rows($result) > 0) {
    //             $items = [];
    //             while($row = mysqli_fetch_assoc($result)) {
    //                 $items[] = $row;
    //             }
    //             $conn->close();
    //             return $items;
    //         } else {
    //             $conn->close();
    //             return false;
    //         }
    //     } else {
    //         echo "Lỗi: " . mysqli_error($conn);
    //     }
    //     $stmt->close();
    // }
    function getFlims_Genre_advan($selected_genres, $search_term = '') {
        $conn = connect();
        $query = "SELECT * FROM films";
        $where = [];
        $params = [];
    
        // Lấy danh sách các thể loại được chọn từ mảng 1 chiều
        $genres = [];
        foreach ($selected_genres as $genre) {
            if (!empty($genre)) {
                $genres[] = $genre;
            }
        }
    
        // Tạo điều kiện WHERE dựa trên các thể loại được chọn
        if (!empty($genres)) {
            // Tạo một mảng các khóa với giá trị true tương ứng với các thể loại được chọn
            $genre_keys = array_fill_keys($genres, true);
    
            // Tạo điều kiện WHERE dựa trên các thể loại được chọn
            $genre_count = count($genres);
            $genre_conditions = array_fill(0, $genre_count, 'genre LIKE ?');
            $where[] = '(' . implode(' AND ', $genre_conditions) . ')';

            // Lấy các khóa tương ứng với các thể loại phù hợp
            $params = array_map(function($genre) {
                return "%$genre%";
            }, $genres);

        }
        if (empty($params)) {
            $conn->close();
            return false;
        }
    
        // Thêm điều kiện tìm kiếm nếu có
        if (!empty($search_term)) {
            $where[] = "name_flim LIKE ?";
            $params[] = "%$search_term%";
        }
    
        // Nếu có điều kiện WHERE, thêm vào câu truy vấn
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
    
    
    
    
    
    
?>