<?php

include('MariaGarden.php'); 


function sanitize_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
    $name = sanitize_input($_POST['name']);
    $email = sanitize_input($_POST['email']);
    $phone = sanitize_input($_POST['phone']);
    $time = sanitize_input($_POST['time']);
    $date = sanitize_input($_POST['date']);
    $guests = sanitize_input($_POST['guests']);
    $comment = sanitize_input($_POST['comment']);

   
    $check_email_query = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($check_email_query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 0) {
        
        echo "<script>alert('Вам потрібно зареєструватися, щоб зробити бронювання.'); window.location.href='registration.html';</script>";
    } else {
       
        $check_query = "SELECT * FROM reservations WHERE date = ? AND time = ?";
        $stmt = $conn->prepare($check_query);
        $stmt->bind_param("ss", $date, $time);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
           
            echo "<script>alert('Бронювання неможливе, оскільки столик на цю дату та годину вже заброньовано!'); window.location.href='index.php';</script>";
        } else {
        
            $insert_query = "INSERT INTO reservations (name, email, phone, time, date, guests, comment) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($insert_query);
            $stmt->bind_param("sssssis", $name, $email, $phone, $time, $date, $guests, $comment);

            if ($stmt->execute()) {
                echo "<script>alert('Ваше бронювання успішно здійснене!'); window.location.href='index.php';</script>";
            } else {
                echo "<script>alert('Помилка при бронюванні, спробуйте ще раз.'); window.location.href='index.php';</script>";
            }
        }
    }
}
?>
