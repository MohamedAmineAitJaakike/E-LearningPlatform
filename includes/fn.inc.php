<?php
//include('connection.inc.php');
function valider($conn, $username, $password) {
    $errors = array();
    if (empty($username)) {
        $errors[] = "Le nom d'utilisateur ne doit pas être vide";
    } elseif (strlen($username) < 3) {
        $errors[] = "Le nom d'utilisateur doit avoir au moins 3 caractères";
    } else {
        // Vérifie si le pseudo existe déjà
        if (check_user_pseudo($conn, $username)) {
            $errors[] = "Le pseudo existe déjà";
        }
    }
    if (empty($password)) {
        $errors[] = "Le mot de passe ne doit pas être vide";
    } elseif (strlen($password) < 3) {
        $errors[] = "Le mot de passe doit avoir au moins 3 caractères";
    }
    return $errors;
}

function check_user_pseudo($conn, $username) {
    $sql = "SELECT * FROM USERS WHERE NAME = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $results = $stmt->get_result();
    return $results->num_rows > 0;
}
function check_user_email($conn, $email) {
    $sql = "SELECT * FROM USERS WHERE EMAIL = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $results = $stmt->get_result();
    return $results->num_rows > 0;
}

function register($conn, $username, $password) {
    $hashed_password = hash('sha256', $password);
    $sql = "INSERT INTO USERS (USERNAME, PASSWORD) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $hashed_password);
    return $stmt->execute();
}
function login_user($conn, $username, $password)
{
    //$hashed_password = hash('sha256', $password);
    $sql = "SELECT * FROM utilisateurs WHERE mail = ? AND PASSWORD = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss",$username,$password);
    $stmt->execute();
    $results = $stmt->get_result();
    return $results->fetch_assoc();
}
function save_remember_token($conn,$user_id,$token) {
    $sql = "UPDATE USERS SET remember_token = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si",$token,$user_id);
    return $stmt->execute();
}
function save_reset_token($conn,$user_id,$token) {
    $sql = "UPDATE USERS SET reset_token = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si",$token,$user_id);
    return $stmt->execute();
}
function get_user_tasks($conn,$user_id){
    $sql = "SELECT * FROM TASKS WHERE USER_ID = ? ";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i",$user_id);
    $stmt->execute();
    return $stmt->get_result();
}
function get_task($conn,$task_id) {
    $sql = "SELECT * FROM tasks WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i",$task_id);
    $stmt->execute();

    return $stmt->get_result();
}
function add_task($conn, $user_id, $task_title, $task_description, $task_date ) {
    $sql = "INSERT INTO TASKS (`user_id`,`task_name`,`task_description`,`task_date`,`status`) 
    VALUES (?,?,?,?,?)";
    $s = 0;
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isssi", $user_id,$task_title, $task_description, $task_date,$s);
    return $stmt->execute();
}

function mark_task( $conn, $task_id ) {
    $sql = "UPDATE TASKS SET status = 1 where id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $task_id);

    return $stmt->execute();
}

function update_task( $conn, $task_id, $task_title, $task_description, $task_date ) {
    $sql = "UPDATE TASKS SET 
            task_name = ?, task_description = ?, task_date = ?
            where id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $task_title,$task_description,$task_date,$task_id);

    return $stmt->execute();
}
function delete_task( $conn, $task_id ) {
    $sql = "DELETE FROM TASKS WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $task_id);

    return $stmt->execute();
}
?>
