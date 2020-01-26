
<div aria-label="Page navigation" style='margin-left:150px' class="d-flex justify-content-center mt-4">
    <ul class="pagination" id='pagination'>
        <?php if ($page > 1){
            $previous = $page - 1 ; ?>
            <li class="page-item">  <a href="?page=<?= $previous;  ?>" class="page-link" style='color:#000'>&laquo; Prev</a></li>
        <?php  } ?>

        <?php for ($p=1; $p<= $PageCount; $p++){ 
            $active = ($p == $page) ? ' page-active' : '';
            ?>
            
        <li > <a href="?page=<?= $p; ?>" class="page-link<?=$active?>" style='color:#000'><?= $p; ?> </a> </li>
        <?php } ?>
        <?php if ($page < $PageCount) { ?>
            <li class="page-item">  <a href ="?page=<?= ($page + 1); ?>" class="page-link" style='color:#000'>Next &raquo;</a></li>
        <?php }  ?>
    </ul>
</div>