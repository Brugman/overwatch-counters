<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<!-- app -->
<script src="/assets/js/app.min.js"></script>

<?php if ( in_array( substr( $_SERVER['SERVER_ADDR'], 0, 3 ), array( '127', '192', '172', '10.' ) ) ): ?>
<!-- Livereload -->
<script src="http://<?=$_SERVER['HTTP_HOST'];?>:35729/livereload.js"></script>
<?php endif; // Livereload ?>

</body>
</html>