<?php
require_once "lib/Smarty.class.php";
require_once "database.php";

if(!isValid($_COOKIE['ACTIVE_NOTE_ID'])) {
    setcookie("ACTIVE_NOTE_ID", getMaxId());
    $activeNoteId = getMaxId();
    
    //echo 'in if';
} else {
    $activeNoteId = $_COOKIE['ACTIVE_NOTE_ID'];
}

//
switch($_REQUEST['action']) {
    case 'delete':
        deleteNote($activeNoteId);
        $newId = getMaxId();
        setcookie("ACTIVE_NOTE_ID", $newId);
        $activeNoteId = $newId;
        break;
    case 'update':
        updateNote($_COOKIE['ACTIVE_NOTE_ID'], $_REQUEST['content']);
        break;
    case 'new':
        createNote("New note.");
        $newId = getMaxId();
        setcookie("ACTIVE_NOTE_ID", $newId);
        $activeNoteId = $newId;
        break;
    case 'navigate':
        setcookie("ACTIVE_NOTE_ID", $_REQUEST['id']);
        $activeNoteId = $_REQUEST['id'];
        break;
    case 'email':
        if (!empty($_POST['address']) && !empty($_POST['subject'])) {
            email($_POST['address'], $_POST['subject'], $activeNoteId);
            //echo '<script>parentDialog.close();</script>';
        } else {
            echo '<script>alert("Not enough infromation!");'
            . 'window.location.assign("emailForm.html");</script>';
        }
        
        break;
}

//initializing an smarty object.
$template = new Smarty();

$template->assign("ACTIVE_NOTE_ID", $activeNoteId);
$template->assign("notes", getNotes());

//Display the html page using templates.
$template->display('index.tpl');
