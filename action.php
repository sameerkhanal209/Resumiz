<?php

function DBConnect(){
    $link = mysqli_connect("localhost", "root", "", "resumiz");

    if($link->connect_error){
        die("There is an error connecting to the database 🥲");
    }

    return $link;
}

function addToDatabase($data){

    $table = $data['table'];

    $keys = array_keys($data['fields']);
    $values = array_values($data['fields']);

    $fields = implode(",", $keys);

    $values = array_map(function($element) {
        return '"' . $element . '"';
    }, $values);
    
    $values = implode(",", $values);

    $conn = DBConnect();
    $sql = "INSERT INTO $table ($fields) VALUES ($values)";
    $result = mysqli_query($conn, $sql);

    return $result;

}

function getFromDatabase($data, $where = null){

    $table = $data['table'];
    $keys = array_values($data['fields']);

    $fields = implode(",", $keys);

    $conn = DBConnect();

    if($where){
        $sql = "SELECT $fields FROM $table WHERE $where";
    } else {
        $sql = "SELECT $fields FROM $table";
    }
    $result = mysqli_query($conn, $sql);

    return $result;

}

function updateDatabase($data, $where){

    $table = $data['table'];

    $table = $data["table"];
    $fields = $data["fields"];

    $updateQuery = "";

    $updateValues = [];
    foreach ($fields as $key => $value) {
        $updateValues[] = "`$key` = '" . $value . "'";
    }

    $updateQuery .= implode(", ", $updateValues);

    $conn = DBConnect();
    //$sql = "INSERT INTO $table ($fields) VALUES ($values)";
    $sql = "UPDATE $table SET $updateQuery WHERE $where";

    print_r($sql);

    $result = mysqli_query($conn, $sql);

    return $result;
}


function Signup($fname, $lname, $email, $password){

    $password = password_hash($password, PASSWORD_DEFAULT);

    $data = [
        "table" => "users",
        "fields" => [
            "fname" => $fname,
            "lname" => $lname,
            "email" => $email,
            "password" => $password
        ]
    ];

    addToDatabase($data);
    
}


function Login($email, $password){
    
        $data = [
            "table" => "users",
            "fields" => [
                "id",
                "fname",
                "lname",
                "email",
                "password"
            ]
        ];
    
        $result = getFromDatabase($data, "email = '$email'");
    
        if($result->num_rows > 0){
            $user = $result->fetch_assoc();

            if(password_verify($password, $user['password'])){
                $_SESSION['user'] = $user;

                $_SESSION['message'] = "Login successful for email: $email";

                header("Location: 1.php");
            } else {
                $_SESSION['error'] = "Invalid password";
            }
        } else {
            $_SESSION['error'] = "Invalid email";
        }

}

function getResumeData($userid){
    
        $data = [
            "table" => "resume",
            "fields" => [
                "fname",
                "lname",
                "email",
                "phone",
                "address",
                "title",
                "description",
                "photo",
                "education",
                "skills",
                "experience"
            ]
        ];
    
        $result = getFromDatabase($data, "created_by = '$userid'");
    
        if($result->num_rows > 0){
            $resume = $result->fetch_assoc();
    
            return $resume;
        } else {
            return false;
        }
}

?>