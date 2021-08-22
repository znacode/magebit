<?php

class SubEmail
{

    public $id;

    public $email;

    public $create_date;

    public $checkbox;

    public $errors = [];


    public function getAll($conn)
    {
        $sql = "SELECT *
                FROM addresses
                ORDER BY create_date DESC;";

        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    protected function validate()
    {
        if ($this->email == '') {
            $this->errors[] = 'Email address is required';
        } elseif (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $this->errors[] = 'Please provide a valid e-mail address';
        } elseif ($this->checkbox == '') {
            $this->errors[] = 'You must accept the terms and conditions';
        } elseif (preg_match("/^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[co]{2,3}$/", $this->email)) {
            $this->errors[] = 'We are not accepting subscriptions from Colombia emails';
        } else {
        }

        return empty($this->errors);
    }


    public function create($conn)
    {
        if ($this->validate()) {
            $sql = "INSERT INTO addresses
                    (email, create_date)
                    VALUES (:email, :date)";

            $stmt = $conn->prepare($sql);

            $stmt->bindValue(':email', $this->email, PDO::PARAM_STR);
            $stmt->bindValue(':date', date('Y-m-d H:i:s'), PDO::PARAM_STR);

            return $stmt->execute();
        } else {
            return false;
        }
    }


    public function delete($conn)
    {
        $sql = "DELETE FROM addresses
                WHERE id = :id";

        $stmt = $conn->prepare($sql);

        $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);

        return $stmt->execute();
    }


    public function search($conn, $search)
    {
        $stmt = $conn->prepare("SELECT * FROM addresses
                            WHERE email LIKE :email
                            ORDER BY create_date DESC");

        $stmt->bindValue(':email', "%$search%");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function filterButton($conn)
    {
        $sql = "SELECT DISTINCT SUBSTRING_INDEX(SUBSTRING_INDEX(email, '.', +1), '@', -1)
                AS emailDomain FROM addresses";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function searchEmail($conn, $emailButton)
    {
        $sql = "SELECT * FROM addresses
                WHERE email LIKE :email
                ORDER BY create_date DESC";

        $stmt = $conn->prepare($sql);

        $stmt->bindValue(':email', "%$emailButton%");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }


    public function sort($conn, $emailButton)
    {
        $sql = "SELECT * FROM addresses
                WHERE email LIKE :email
                ORDER BY email ASC";

        $stmt = $conn->prepare($sql);

        $stmt->bindValue(':email', "%$emailButton%");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
