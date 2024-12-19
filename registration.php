<?php


include 'MariaGarden.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];

   
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    
    $checkQuery = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($checkQuery);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        echo "Користувач з таким email вже існує.";
    } else {
     
        $query = "INSERT INTO users (email, phone, password) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sss", $email, $phone, $hashed_password);
        if ($stmt->execute()) {
            echo "Реєстрація успішна!";
        } else {
            echo "Помилка реєстрації: " . $stmt->error;
        }
    }
}
?>

