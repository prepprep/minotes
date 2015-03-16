{include file="header.tpl" title="miNotes"}

<div id="container">

    <div id="notes-list">
        <div id="notes-list-header" class="header">
            <span class="left">miNotes</span>
            <span class="right"><a href="index.php?action=new"><img src="images/CreateNote.png" alt="Create new note."></a></span>
        </div>
        {foreach from=$notes item=note}
            <div class="notes-list-item">
                <span class="notes-list-item-title"><a href="index.php?action=navigate&id={$note.id}" 
                                                       {if $note.id eq $ACTIVE_NOTE_ID}class='active'{/if}>{$note.content|truncate:20}</a></span>
                <span class="notes-list-item-timestamp">{$note.last_modified|date_format:"%b %d"}</span>
            </div>      
        {/foreach}
    </div>

    <div id="notepad">
        <div id="notepad-header" class="header">
            <span><a href="#" onclick="document.getElementById('updateForm').submit();">Save</a></span>&nbsp;|&nbsp;
            <span><a href="index.php?action=delete">Delete</a></span>&nbsp;|&nbsp;
            <span>
                <a href="#" onclick="email()">Email</a>&nbsp;|&nbsp;
            </span>
            
            <span class="right">Fname Lname</span>
        </div>
        <div>
            {foreach from=$notes item=note}
                {if $note.id eq $ACTIVE_NOTE_ID}
                    <span id="timestamp">{$note.last_modified|date_format:"%B %d, %r"}</span>

                    <div id="tinymce-holder">
                        <form action="index.php" method="POST" id="updateForm">
                            <div id="areaContent">
                                <textarea rows="27" cols="70" id="content" name="content">{$note.content}</textarea>
                                <input type="hidden" name="action" value="update"/>
                            </div>
                        </form>
                        <form action="index.php?action=addcomment" method="post" id="updateComment">
                            <div id="areaComment">
                                <textarea rows="3" cols="70" name="comment" id="comment">{$note.comment}</textarea>
                                <br/><input type="submit" name="submit" value="Add Reminder:"/>
                            </div>
                        </form>   
                    </div>

                {/if}
            {/foreach}
        </div>
    </div>
</div>

{include file="footer.tpl"}
