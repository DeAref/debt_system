<footer class="main-footer">
    <strong>حق نشر &copy; <?php echo date('Y'); ?> <a href="https://github.com/DeAref/">Aref Solaimany</a>.</strong>
</footer>

<aside class="control-sidebar control-sidebar-dark" aria-label="پنل کناری"></aside>
</div>

<script src="../plugins/jquery/jquery.min.js"></script>
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../dist/js/adminlte.js"></script>
<script src="../plugins/ckeditor/ckeditor.js"></script>
<script>
(function ($) {
    'use strict';
    $(function () {
        var textarea = document.querySelector('#compose-textarea');
        if (textarea && typeof ClassicEditor !== 'undefined') {
            ClassicEditor.create(textarea).catch(function (error) {
                if (window.console && console.error) console.error(error);
            });
        }
    });
})(window.jQuery);
</script>
</body>
</html>
