<?php
    if (!empty($statusMessage)){
        echo "<div id='system-alert' class='alert alert-" . $statusType . "' role='alert'>";
        echo $statusMessage;
        echo "</div>";
    }
?>