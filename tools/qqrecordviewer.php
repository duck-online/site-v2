<div>
    <form action='.'>
        path:<input type='text' name='path' placeholder="linux path"><br>
    </form>
</div>
<pre>
<?php
//load file
if ($_GET['path']){
    $txt=file_get_contents($_GET['path']);
    $txt=preg_replace($txt,"\\d4-\\d2-\\d2 \\d2:\\d2:\\d2 某科学的可达鸭【gundam】\\(\\d*\\)","|duck|$0|");
    print($txt);
    
}

?>
</pre>