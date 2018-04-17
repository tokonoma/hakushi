<!--js-->
<!--jquery-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script>
    //if local fallback is available 
    window.jQuery || document.write('<script src="assets/js/jquery-3.1.1.min.js"><\/script>')
</script>

<!--bootstrap.js and CSS fallback-->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script>
    //if local fallback is available
    window.jQuery.fn.modal || document.write('<script src="assets/bootstrap/js/bootstrap.min.js"><\/script>')
</script>
<script>
    (function($) {
        $(function() {
             if ($('#bootstrapCssTest').is(':visible') === true) {
                $('head').prepend('<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">');
            }
        });
    })(window.jQuery);
</script>

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script src="assets/js/sortable.js"></script>
<script src="assets/js/allowance.js"></script>
<script src="assets/js/links.js"></script>

<script src="https://maxcdn.bootstrapcdn.com/js/ie10-viewport-bug-workaround.js"></script>