	</div>
</div>


    <script src="<?= base_url('assets/dist/js/bootstrap.bundle.min.js') ?>"></script>

      <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
      <script src="<?= base_url('assets/dist/js/dashboard.js') ?>"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
      
      <?php if (!empty($js_plugins) ): ?>
        <script type="text/javascript" src="<?= base_url('assets/dist/'.$js_plugins) ?>"></script>
      <?php endif; ?>

      <?php !empty($js) ? $this->load->view($js) : ''; ?>

  </body>
</html>