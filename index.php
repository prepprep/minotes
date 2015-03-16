<?php
//Use the predefined classes in the smarty library.
require_once "lib/Smarty.class.php";
//Include the functions written in database.php.
require_once "database.php";

//If no id selected, auto select the maximum id.
if(!isValid($_COOKIE['ACTIVE_NOTE_ID'])) {
    //Store the max id into cookie which is stored in client.
    setcookie("ACTIVE_NOTE_ID", getMaxId());
    $activeNoteId = getMaxId();
    
    //echo 'in if';
} else {
    $activeNoteId = $_COOKIE['ACTIVE_NOTE_ID'];
}

//Doing different action by accepting different variables.
switch($_REQUEST['action']) {
    case 'delete':
        //Delete the row with the target id in table notes.
        deleteNote($activeNoteId);
        $newId = getMaxId();
        setcookie("ACTIVE_NOTE_ID", $newId);
        $activeNoteId = $newId;
        break;
    case 'update':
        //Update the content of the target id.
        updateNote($_COOKIE['ACTIVE_NOTE_ID'], $_REQUEST['content']);
        break;
    case 'new':
        //Create a new note with the content= "New Note."
        createNote("New note.");
        $newId = getMaxId();
        setcookie("ACTIVE_NOTE_ID", $newId);
        $activeNoteId = $newId;
        break;
    case 'navigate':
        //Get the id of the selected content.
        setcookie("ACTIVE_NOTE_ID", $_REQUEST['id']);
        $activeNoteId = $_REQUEST['id'];
        break;
    case 'email':
        //Check the address and subject available or not.
        if (!empty($_POST['address']) && !empty($_POST['subject'])) {
            email($_POST['address'], $_POST['subject'], $activeNoteId);
            
        } else {
            //Show error information.
            echo '<script>alert("Not enough infromation!");'
            . 'window.location.assign("emailForm.html");</script>';
        }
        
        break;
    case 'reminder':
        if (!empty($_REQUEST['reminder'])) {
            addReminder($activeNoteId, $_REQUEST['reminder']);
        }else {
            echo '<script>alert("Reminder could not be empty!");</script>';
        }
        break;
    
}

//initializing an smarty object.
$template = new Smarty();

//Assign values to the template, in this case, index.tpl
$template->assign("ACTIVE_NOTE_ID", $activeNoteId);
$template->assign("notes", getNotes());

//Display the html page using templates.
$template->display('index.tpl');
