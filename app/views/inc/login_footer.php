     <footer class="auth-footer"> © 2021 All Rights Reserved. </footer>
    </main><!-- /.auth -->
    <!-- BEGIN BASE JS -->
    <script src="<?php echo URLROOT; ?>/assets/vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo URLROOT; ?>/assets/vendor/bootstrap/js/popper.min.js"></script>
    <script src="<?php echo URLROOT; ?>/assets/vendor/bootstrap/js/bootstrap.min.js"></script> <!-- END BASE JS -->
    <!-- BEGIN PLUGINS JS -->
    <script src="<?php echo URLROOT; ?>/assets/vendor/particles.js/particles.min.js"></script>
    <script>
      /**
       * Keep in mind that your scripts may not always be executed after the theme is completely ready,
       * you might need to observe the `theme:load` event to make sure your scripts are executed after the theme is ready.
       */
      $(document).on('theme:init', () =>
      {
        /* particlesJS.load(@dom-id, @path-json, @callback (optional)); */
        particlesJS.load('auth-header', '<?php echo URLROOT; ?>/assets/javascript/pages/particles.json');
      })
    </script> <!-- END PLUGINS JS -->
    <!-- BEGIN THEME JS -->
    <script src="<?php echo URLROOT; ?>/assets/javascript/theme.js"></script> <!-- END THEME JS -->
  </body>
</html>