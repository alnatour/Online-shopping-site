<?php
require '../include.php';

include(ROOT_PATH . '/header.php') ;
?>

<br><br><br><br><br><br><br>
<div class="container">
    <div class="row">
        <div id="content">
        <table width="700px" cellspacing="0" cellpadding="5">
                     <tbody><tr bgcolor="#CCCCCC">
                        <th width="220" align="left">Image </th> 
                        <th width="180" align="left">Description </th> 
                             <th width="100" align="center">Quantity </th> 
                        <th width="60" align="right">Price </th> 
                        <th width="60" align="right">Total </th> 
                        <th width="90"> </th>
                        
                  </tr>
                    <tr>
                        <td><img src="images/product/01.jpg" alt="image 01"></td> 
                        <td>Etiam in tellus</td> 
                        <td align="center"><input type="text" value="1" style="width: 20px; text-align: right"> </td>
                        <td align="right">$100 </td> 
                        <td align="right">$100 </td>
                        <td align="center"> <a href="#"><img src="images/remove_x.gif" alt="remove"><br>Remove</a> </td>
                    </tr>
                    <tr>
                        <td><img src="images/product/02.jpg" alt="image 02"> </td>
                        <td>Hendrerit justo</td> 
                             <td align="center"><input type="text" value="1" style="width: 20px; text-align: right">  </td>
                        <td align="right">$40  </td>
                        <td align="right">$40 </td>
                        <td align="center"> <a href="#"><img src="images/remove_x.gif" alt="remove"><br>Remove</a>  </td>
                    </tr>
                    <tr>
                        <td colspan="3" align="right" height="40px">Have you modified your basket? Please click here to <a href="shoppingcart.html"><strong>Update</strong></a>&nbsp;&nbsp;</td>
                        <td align="right" style="background:#ccc; font-weight:bold"> Total </td>
                        <td align="right" style="background:#ccc; font-weight:bold">$140 </td>
                        <td style="background:#ccc; font-weight:bold"> </td>
                    </tr>
                </tbody></table>
                <div style="float:right; width: 215px; margin-top: 20px;">
                
                    <div class="checkout"><a href="checkout.php" class="more">Proceed to Checkout</a></div>
                    <div class="cleaner h20"></div>
                    <div class="continueshopping"><a href="javascript:history.back()" class="more">Continue Shopping</a></div>
                    
                </div>
            </div>
        </div>
    </div>