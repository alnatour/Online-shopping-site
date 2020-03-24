<!-- Comment -->
<div class="leave-comment" style="display:<?php if(isset($rating)){echo '';}?> ">
    <form action="<?php echo BASE_URL . 'controlle/reviews_controlle.php'?>" method="post" class="comment-form">
        <div class="row">
            <input type="hidden" name="pid" value="<?= $id ?>">
            <div class="col-lg-10">
                <textarea placeholder="Messages" name="comment"><?= (isset($ratingusers)) ? $ratingusers['comment'] : ''; ?></textarea>
                <button type="submit" name="comment_submit" class="site-btn">Send message</button>
            </div>
        </div>
    </form>
</div>