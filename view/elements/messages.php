<?php if (isset($_SESSION['message'])) { ?>
      <div class="bg-warning">
          <?php 
            foreach($_SESSION['message'] as $notice){ ?>
            <p class="text-white mt-3 ml-4"><?= $notice ?></p>
      </div>
    <?php }
    unset($_SESSION['message']);
} ?>