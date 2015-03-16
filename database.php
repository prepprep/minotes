<?php

require 'vars.php';
//There are many lines of repeated code, in this case, document each repeated
//line just once.

/**
 * The purpose of this function is to send emails.
 * 
 * @param type $to
 * @param type $subject
 * @param type $id
 */

function email($to, $subject, $id) {
    try {
        //Initial a connection to database.
        $connection = new PDO(db_dsn, db_username, db_passwd);
        //The objects are created by default in the public schema, in order to 
        //save the effort traverse all search path, just use public.
        $connection->exec('SET search_path TO public'); 
        //Prepare a statement for execution and return a statement object.
        $query = $connection->prepare("SELECT content FROM notes WHERE id = :id");
        //Binds a php variable to a corresponding name in the SQL statement.
        //Here ':id' as a parameter marker.
        $query->bindParam(':id', $id);
        //Execute the prepared statement above.
        $query->execute();
        //Return the content under the select id and cast it to string.
        $mesg = (string)$query->fetch();
        //Mail the content to the person with the email-address $to.
        mail($to, $subject, $mesg);
        
        //confirm the email has been sent.
        echo '<script>alert("Sending complete.");'
        . 'window.location.assign("emailForm.html");</script>';
    } catch (Exception $ex) {
        //Print the error messages to screen.
        echo $ex->getMessage();
    }
}

/**
 * This function is to insert content to the notes.
 * 
 * @param type $content
 */
function createNote($content) {

    try {
        $connection = new PDO(db_dsn, db_username, db_passwd);
        $connection->exec('SET search_path TO public');
        //Insert a new content in the table notes.
        $query = $connection->prepare("INSERT INTO notes (content) VALUES (:content);");
        $query->bindParam(':content', $content);
        $query->execute();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

/**
 * This function is used to get all the elements in the notes
 * and place them in descending order.
 * 
 * @return type
 */
function getNotes() {
    try {
        $connection = new PDO(db_dsn, db_username, db_passwd);
        $connection->exec('SET search_path TO public');
        //Return all information in table notes in descending order .
        $query = $connection->prepare("SELECT * FROM notes ORDER BY last_modified DESC;");
        $query->execute();
        //Return all information fetched from table notes.
        return $query->fetchAll();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

/**
 * Each row in the table notes has an id, this function selects the 
 * minimum id as default.
 * 
 * @return type string
 */
function getMinId() {
    try {
        $connection = new PDO(db_dsn, db_username, db_passwd);
        $connection->exec('SET search_path TO public');
        //Get the minimum id number.
        $query = $connection->prepare("SELECT min(id) FROM notes;");
        $query->execute();
        $str = (string)$query->fetch();
        return $str;
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}


/**
 * This function choose the maximum id as default id.
 * 
 * @return type string
 */
function getMaxId() {
    try {
        $connection = new PDO(db_dsn, db_username, db_passwd);
        $connection->exec('SET search_path TO public');
        //Get the maximum id number.
        $query = $connection->prepare("SELECT max(id) FROM notes;");
        $query->execute();
        $str = (string)$query->fetch();
        return $str;
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

/**
 * This function aims to check whether the input id is in the table.
 * 
 * @param type $id
 * @return type
 */
function isValid($id) {
    try {
        $connection = new PDO(db_dsn, db_username, db_passwd);
        $connection->exec('SET search_path TO public');
        //Get all information of the target id.
        $query = $connection->prepare("SELECT * FROM notes WHERE id = :id;");
        $query->bindParam(':id', $id);
        $query->execute();

        return count($query->fetchAll()) > 0;
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}


/**
 * This function is trying to delete all the elements associated with
 * the selected id.
 * 
 * @param type $id
 * 
 */
function deleteNote($id) {
    try {
        $connection = new PDO(db_dsn, db_username, db_passwd);
        $connection->exec('SET search_path TO public');
        //Delete the row in table notes with the target id.
        $query = $connection->prepare("DELETE FROM notes WHERE id = :id;");
        $query->bindParam(':id', $id);
        $query->execute();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

/**
 * When the content of the notes has been modified, this function will update
 * the modified content in the database.
 * 
 * @param type $id
 * @param type $newContent
 */
function updateNote($id, $newContent) {
    try {
        $connection = new PDO(db_dsn, db_username, db_passwd);
        $connection->exec('SET search_path TO public');
        //Update the content of the target id.
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

function addReminder($id, $newComment) {
    
    try {
        $connection = new PDO(db_dsn, db_username, db_passwd);
        $connection->exec('SET search_path TO public');
        //Update the content of the target id.
        $query = $connection->prepare("UPDATE notes
                                       SET comment = :comment,
                                           last_modified = CURRENT_TIMESTAMP
                                       WHERE id = :id");
        $query->bindParam(':id', $id);
        $query->bindParam(':comment', $newComment);
        $query->execute();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

?>
