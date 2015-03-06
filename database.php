<?php
function email($to, $subject, $id) {
    try {
        $connection = new PDO('pgsql:host=localhost;port=5432;dbname=minotes', "postgres", "apassword");
        $connection->exec('SET search_path TO public');        
        $query = $connection->prepare("SELECT content FROM notes WHERE id = :id");
        
        $query->bindParam(':id', $id);
        $query->execute();
        $mesg = (string)$query->fetch();

        mail($to, $subject, $mesg);
        echo '<script>alert("Sending complete.");'
        . 'window.location.assign("emailForm.html");</script>';
    } catch (Exception $ex) {
        echo $ex->getMessage();
    }
}

function createNote($content) {

    try {
        $connection = new PDO('pgsql:host=localhost;port=5432;dbname=minotes', "postgres", "apassword");
        $connection->exec('SET search_path TO public');

        $query = $connection->prepare("INSERT INTO notes (content) VALUES (:content);");
        $query->bindParam(':content', $content);
        $query->execute();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

function getNotes() {
    try {
        $connection = new PDO('pgsql:host=localhost;port=5432;dbname=minotes', "postgres", "apassword");
        $connection->exec('SET search_path TO public');

        $query = $connection->prepare("SELECT * FROM notes ORDER BY last_modified DESC;");
        $query->execute();

        return $query->fetchAll();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

function getMinId() {
    try {
        $connection = new PDO('pgsql:host=localhost;port=5432;dbname=minotes', "postgres", "apassword");
        $connection->exec('SET search_path TO public');

        $query = $connection->prepare("SELECT min(id) FROM notes;");
        $query->execute();
        $str = (string)$query->fetch();
        return $str;
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

function getMaxId() {
    try {
        $connection = new PDO('pgsql:host=localhost;port=5432;dbname=minotes', "postgres", "apassword");
        $connection->exec('SET search_path TO public');

        $query = $connection->prepare("SELECT max(id) FROM notes;");
        $query->execute();
        $str = (string)$query->fetch();
        return $str;
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

function isValid($id) {
    try {
        $connection = new PDO('pgsql:host=localhost;port=5432;dbname=minotes', "postgres", "apassword");
        $connection->exec('SET search_path TO public');

        $query = $connection->prepare("SELECT * FROM notes WHERE id = :id;");
        $query->bindParam(':id', $id);
        $query->execute();

        return count($query->fetchAll()) > 0;
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

function deleteNote($id) {
    try {
        $connection = new PDO('pgsql:host=localhost;port=5432;dbname=minotes', "postgres", "apassword");
        $connection->exec('SET search_path TO public');

        $query = $connection->prepare("DELETE FROM notes WHERE id = :id;");
        $query->bindParam(':id', $id);
        $query->execute();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

function updateNote($id, $newContent) {
    try {
        $connection = new PDO('pgsql:host=localhost;port=5432;dbname=minotes', "postgres", "apassword");
        $connection->exec('SET search_path TO public');

        $query = $connection->prepare("UPDATE notes
                                       SET content = :content,
                                           last_modified = CURRENT_TIMESTAMP
                                       WHERE id = :id");
        $query->bindParam(':id', $id);
        $query->bindParam(':content', $newContent);
        $query->execute();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

?>
