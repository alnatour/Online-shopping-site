<?php
require '../include.php';

include(ROOT_PATH . '/header.php') ;
?>

<br><br><br><br><br><br>
<div class="container">
    <div class="row">
        <div id="content">
            <h2>Checkout</h2>
            <h5><strong>BILLING DETAILS</strong></h5>

            <div class="col col_13 checkout" style="width: 300px;float: left;margin-right: 20px;">
                Enter your full name as it is on the credit card:
                <input type="text" style="width:300px;">
                Address:
                <input type="text" style="width:300px;">
                City:
                <input type="text" style="width:300px;">
                Country:
                <input type="text" style="width:300px;">
            </div>
            
            <div class="col col_13 checkout mt-4" style="width: 300px;float: left;margin-right: 20px;">
                E-MAIL
                <input type="text" style="width:300px;">
                PHONE<br>
                <span style="font-size:10px">Please, specify your reachable phone number. YOU MAY BE GIVEN A CALL TO VERIFY AND COMPLETE THE ORDER.</span>
                <input type="text" style="width:300px;">
            </div>
            
            <div style="height:50px"></div>


            <br><br><br><br><br><br><br><br><br><br>
            <h3>Shopping Cart</h3>
            <h4>TOTAL: <strong>$140</strong></h4>
            <p><input type="checkbox">I have accepted the <a href="#">Terms of Use</a>.</p>
            <table style="border:1px solid #CCCCCC;" width="100%">
                <tbody>
                    <tr>
                        <td height="80px"> <img src="images/paypal.gif" alt="paypal"></td>
                        <td width="400px;" style="padding: 0px 20px;">Recommended if you have a PayPal account. Fastest delivery time.</td>
                        <td><a href="#" class="more">PAYPAL</a></td>
                    </tr>
                    <tr>
                        <td height="80px"><img src="images/2co.gif" alt="paypal"></td>
                        <td width="400px;" style="padding: 0px 20px;">2Checkout.com, Inc. is an authorized retailer of goods and services provided by Template-Guide.com. 2CheckOut accepts customer orders via online checks, Visa, MasterCard, Discover, American Express, Diners, JCB and debit cards with the Visa, Mastercard logo.
                        </td>
                        <td><a href="#" class="more">2CHECKOUT</a></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>



 <br><br><br><br><br><br>
 <?php include(ROOT_PATH . '/footer.php') ?>