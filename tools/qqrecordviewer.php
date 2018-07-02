<div>
    <form action='.'>
        path:<input type='text' name='path' placeholder="linux path"><br>
    </form>
</div>
<?php
//load file
if ($_GET['path']){
    $txt=file_get_contents($_GET['path']);
    print($txt);
}

?>