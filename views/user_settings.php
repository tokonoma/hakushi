<?php include('views/settings_logic.php'); ?>


<!--HTML INCLUDES-->

<?php include('views/header.php'); ?>

<?php include('views/nav.php'); ?>

<?php include('views/settings_html.php'); ?>


<!--BOTTOM-->

<?php include('views/commonjs.php'); ?>

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

<script>
    $(function() {
        $(".save-settings-btn").click(function(){
            document.getElementById("settings-form").submit();
        });
    })
</script>

<?php include('views/ender.php'); ?>