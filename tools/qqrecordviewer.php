<div>
    <form action='#'>
        path:<input type='text' name='path' placeholder="linux path"><br>
    </form>
</div>
<pre>
<?php
//load file
if ($_GET['path']){
    $txt=file_get_contents($_GET['path']);
    $txt=preg_replace('/\d+-\d+-\d+ \d+:\d+:\d+.*\(\d+\)/',"|duck|$0|",$txt);
    print($txt);
    
}

?>
</pre>