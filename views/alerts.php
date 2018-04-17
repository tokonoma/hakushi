<?php
    if (!empty($statusMessage)){
        echo "<div id='' class='alert alert-" . $statusType . " notif-alert' role='alert'>";
        echo $statusMessage;
        echo "</div>";
    }
?>