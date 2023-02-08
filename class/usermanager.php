<?php

class UserManager {
    public static function display() {
        $conn = DB::connect();
        $result = $conn->query("SELECT * FROM users");
        $html = '<table>';
        $html .= '<tr>';
        $html .= '<th>ID</th>';
        $html .= '<th>Username</th>';
        $html .= '<th>Email</th>';
        $html .= '<th>Action</th>';
        $html .= '</tr>';
        while($row = $result->fetch_assoc()) {
            $html .= '<tr>';
            $html .= '<td>'.$row['id'].'</td>';
            $html .= '<td>'.$row['username'].'</td>';
            $html .= '<td>'.$row['email'].'</td>';
            $html .= '<td>';
            $html .= '<a href="./updateuser.php?id='.$row['id'].'">Update</a>';
            $html .= '<a href="./deleteuser.php?id='.$row['id'].'">Delete</a>';
            $html .= '</td>';
            $html .= '</tr>';
        }
        $html .= '</table>';
        return $html;
    }

    public static function delete($id) {
        $conn = DB::connect();
        $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
        $conn->close();
    }

    public static function update($id, $username, $email) {
        $conn = DB::connect();
        $stmt = $conn->prepare("UPDATE users SET username = ?, email = ? WHERE id = ?");
        $stmt->bind_param("ssi", $username, $email, $id);
        $stmt->execute();
        $stmt->close();
        $conn->close();
    }
}
