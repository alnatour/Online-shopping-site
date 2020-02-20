<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
    <input type="hidden" name="cmd" value="_s-xclick">
    <input type="hidden" name="hosted_button_id" value="Y2KHB4CCGF2RW">
    <input type="hidden" name="lc" value="US"> <!--  language change-->
    <input type="hidden" name="currency_code" value="EUR">

    <input type="hidden" name="item_name" value="All Products">
    <input type="hidden" name="business" value="<?=$_SESSION['user']->getEmail()?>">
    <input type="hidden" name="quantity" value="" />
    <input type="hidden" name="amount" value="<?= $cartTotalPrice ?>">
    
    <input type="hidden" name="item_number" value="1"> 
    <input type="hidden" name="button_subtype" value="services">
    <input type="hidden" name="no_note" value="0">
    <input type="hidden" name="tax_rate" value="0.00">
    <input type="hidden" name="shipping" value="0.00">
    
    
    <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
    <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>
    
