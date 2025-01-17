<?php
session_start();
include 'MariaGarden.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
        if (password_verify($password, $user['password'])) {
          
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['email'] = $user['email'];
            
           
            header("Location: index.php");
            exit;
        } else {
            echo "Невірний пароль.";
        }
    } else {
        echo "Користувача з таким email не існує. Вам потрібно зареєструватися.";
    }
}
?>
