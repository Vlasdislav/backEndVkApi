<?php


function isCommonPassword($conn, $password) {
    $query = "SELECT id, password
                FROM `common_passwords`
                WHERE password = $password
                LIMIT 0,1";

    $stmt = $conn->prepare($query);

    $password = htmlspecialchars(strip_tags($password));
    $stmt->bindParam(1, $password);

    $stmt->execute();

    $num = $stmt->rowCount();

    if ($num > 0) {
        return true;
    }
    return false;
}
