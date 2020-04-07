<?php
require '../../../config.php';

use PHPMailer\PHPMailer\PHPMailer;

if(!isset($_SESSION['user']) )
{	// not logged in
    echo "
    <script>
        if (window.confirm('You must login or register first. If you click OK you would be redirected to Login Page. Cancel will load Home website ')) 
        {
        window.location.href='http://localhost/xampp/2020/20.11.2019%20Produkts/kontakte_verwalten/view/user/login.php';
        }else{
            window.location.href='http://localhost/xampp/2020/20.11.2019%20Produkts/kontakte_verwalten/index.php';
        };
    </script>";

    header('Refresh:0; '.BASE_URL.'view/users/login.php'); 
    die();
}
require_once (ROOT_PATH . '/controlle/cart/show_cart_controller.php');

require_once (ROOT_PATH . '/view/main/contact_us/PHPMailer/PHPMailer.php');
require_once (ROOT_PATH . '/view/main/contact_us/PHPMailer/SMTP.php');
require_once (ROOT_PATH . '/view/main/contact_us/PHPMailer/Exception.php');

$mail = new PHPMailer();

$adressesDb = AdressesDB::getInstance();
$ordersDb = OrdersDb::getInstance();
$usersDb  = ContactDB::getInstance();
$address  = new Address;
$order    = new Order();
$user     = new User();
$errors = array();

$userAddress= $adressesDb->GetAddressUser($_SESSION['user']->getId());
$user= $usersDb->GetUserByid($_SESSION['user']->getId());

if(isset($_POST['submit'])){

  if(empty($_POST['firstName'])){
    array_push($errors, "firstName is required");
  }
  if(empty($_POST['lastName'])){
    array_push($errors, "lastName is required");
  }
  if(empty($_POST['email'])){
    array_push($errors, "Email is required");
  }
  if(empty($_POST['country'])){
    array_push($errors, "Country is required");
  }
  if(empty($_POST['state'])){
    array_push($errors, "State is required");
  }
  if(empty($_POST['zip'])){
    array_push($errors, "Zip is required");
  }
  if(empty($_POST['address'])){
    array_push($errors, "Address is required");
  }
  if (count($errors) == 0) {
  $address->setUser_id($_SESSION['user']->getId());
  $address->setCountry($_POST['country']);
  $address->setState($_POST['state']);
  $address->setZip($_POST['zip']);
  $address->setAddress($_POST['address']);

  if(empty($userAddress)){
    $createAddress = $adressesDb->CreateAddress($address);
  }else{
    $updateAddress = $adressesDb->UpdateAddress($address);
  }

  $order->setUser_id($_SESSION['user']->getId());
  $newOrder = $ordersDb->newOrder($order);
  // Insert Orders in Database
  foreach ($cart as $cartProduct) {
    $order->setOrder_id($newOrder);
    $order->setProduct_id($cartProduct->getId());
    $order->setQuantity($cartProduct->getQuantity());

    $createOrder = $ordersDb->CreateOrder($order);
  }

   // for Billing  Email
  $products     = $ordersDb->GetOrderProductsByOrderId($newOrder);
  $userAddress  = $adressesDb->GetAddressUser($_SESSION['user']->getId());

  $specificationDb  = SpecificationDb::getInstance();
  $articleInfo      = $specificationDb->GetSpeciWithProduct($productId);
    try {

      //Server settings
      $mail->isSMTP();                                            // Send using SMTP
      $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
      $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
      $mail->Username   = 'aaa.alnatour@gmail.com';                     // SMTP username
      $mail->Password   = 'abdo770421';                               // SMTP password
      $mail->SMTPSecure = "ssl";         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
      $mail->Port       = 465;                   //587                 // TCP port to connect to

      //Recipients
      $mail->setFrom($user->getEmail(), $user->getLastname());
      $mail->addAddress('abdo.alnatoor@gmail.com', 'alnatoor');     // Add a recipient

      // Content
      $mail->isHTML(true);                                  // Set email format to HTML
      $mail->Subject = "Invoice your purchase";

      $userEmail      = $user->getEmail();
      $userFirstname  = ucfirst($user->getFirstname());
      $userLastname   = ucfirst($user->getLastname());

      $userCountry  = ucfirst($userAddress->getCountry());
      $userState    = ucfirst($userAddress->getState());
      $userZip      = ucfirst($userAddress->getZip());
      $userAddress  = ucfirst($userAddress->getAddress());
      $date     = date("Y-m-d h:i:sa");
      $payable  = date('Y-m-d', strtotime("+14 day"));

      $mail->Body  = "<html><head><title>bill</title></head>
                      <body> 
                      <table width='100%' style='background-color:#fcfcfc'><tbody><tr><td height='30'></td><td>
                        <table width='600' align='center' style='font-size:16px;background-color:#ffffff'>
                          <tbody><tr><td>
                        <table  width='100%'>
                          <tbody>
                            <tr>
                              <td align='center' colspan='4' height='30' style='background-color:#ff5555;letter-spacing: 12px;'>
                                 purchase Invoice 
                              </td>
                            </tr>
                            <tr>
                              <td align='right' width='50%'></td>
                              <td align='right' width='50%'>
                                <img src='https://pngimage.net/wp-content/uploads/2018/05/afi%C5%9F-tasar%C4%B1m-png.png' width='100%' height='70px'/></td>
                            </tr>
                            <tr>
                              <td align='left' width='50%'>
                                <table>
                                  <tbody>
                                    <tr> $userFirstname $userLastname </tr>
                                    <tr><td height='5'></td></tr>
                                    <tr> $userAddress </tr>
                                    <tr> $userCountry, $userState, $userZip </tr>
                                    <tr> Phone: (555) 555-5555 </tr>
                                  </tbody>
                                </table>
                              </td>
                              <td align='right' width='50%'>
                                <table>
                                  <tbody>
                                    <tr><td height='20'></td></tr>
                                    <tr><td class='font-weight: bold;font-size: 20px;'>Contact:</td></tr>
                                    <tr><td>Alantour GMBH </td></tr>
                                    <tr><td>Kreuzgasse 44 </td></tr>
                                    <tr><td>Austria, Vienna, 1180</td></tr>
                                    <tr><td>Tel. +43 68 110 86 85 66</td></tr>
                                  </tbody>
                                </table>
                              </td>
                            </tr>

                            <tr> <td colspan='4' height='20'><td> </tr>

                            <tr>
                              <td align='left' width='50%'></td>
                              <td align='right' width='50%'>
                                <table style=' font-size:16px; border: 1px solid #000;' width='100%'>
                                  <tbody>

                                    <tr>
                                      <td style='border-bottom: 1px solid #000;'>
                                        <table width='100%'>
                                          <tbody>
                                            <tr>
                                              <td align='left' width='50%' style='padding: 5px;text-align: left;background: #eee;'>Invoice #</td>
                                              <td align='right' width='50%' > 000$newOrder </td>
                                            </tr>
                                          </tbody>
                                        </table>
                                      </td>
                                    </tr>

                                    <tr>
                                      <td style='border-bottom: 1px solid #000;'>
                                        <table width='100%'>
                                          <tbody>
                                            <tr>
                                              <td align='left' width='50%' style='padding: 5px;text-align: left;background: #eee;'>Date</td>
                                              <td align='right' width='50%'>$date</td>
                                            </tr>
                                          </tbody>
                                        </table>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td>
                                        <table width='100%'>
                                          <tbody>
                                            <tr>
                                              <td align='left' width='50%' style='padding: 5px;text-align: left;background: #eee;'>payable to</td>
                                              <td align='right' width='50%'>$payable</td>
                                            </tr>
                                          </tbody>
                                        </table>
                                      </td>
                                    </tr>

                                  </tbody>
                                </table>
                              </td>
                            </tr>

                            <tr> <td colspan='4' height='20'><td> </tr>
                          <tbody>
                        </table>

                        <table  width='100%' style='border: 1px solid #000;'>
                          <thead style='background: #eee;'>
                              <tr>
                                <th align='left' style='padding: 5px;'>Sr No.</th>
                                <th align='left' style='padding: 5px;'>Product Title</th>
                                <th align='left' style='padding: 5px;'>Unit Cost</th>
                                <th align='left' style='padding: 5px;'>Quantity</th>
                                <th align='left' style='padding: 5px;'>Discount</th>
                                <th align='left' style='padding: 5px;'>Price</th>
                              </tr>
                          </thead>
                          <tbody>
                            ";
                   
                              foreach( $products as $key=>$product){
                              $productTitle= $product['title'];
                              $productPrice= $product['price'];
                              $productDiscount= $product['discount'];
                              $quantity= $product['quantity'];
                              $totalPriceForProduct= number_format($product['price']- (($product['price'] * $product['quantity'])*$productDiscount/100), 2);
                              $totalPrice = number_format($cartTotalPrice, 2);
                              $serialNumber= $key+1;

                              $mail->Body .= "<tr>"; 
                              $mail->Body .= "<td style='padding: 10px;'>$serialNumber</td>";
                              $mail->Body .= "<td style='padding: 10px;'>$productTitle</td>";
                              $mail->Body .= "<td style='padding: 10px;'>$$productPrice</td>";
                              $mail->Body .= "<td style='padding: 10px;'>$quantity</td>";
                              $mail->Body .= "<td style='padding: 10px;'>%$productDiscount</td>";
                              $mail->Body .= "<td style='padding: 10px;'>$$totalPriceForProduct</td>";
                              $mail->Body .= "</tr>"; 
                              }
                              
                              $mail->Body .=  "<tr> 
                                                <td colspan='4'></td>
                                                <td style='padding: 10px;background-color:#eee'>Balance Due</td>
                                                <td style='padding: 10px;background-color:#eee'>$$totalPrice</td>
                                              </tr>
                            </tbody></table>
                        <table width='100%'>
                          <tbody>
                            <tr><td height='20px' width='100%'></td></tr>
                            <tr><td width='100%' align='center' style='border-bottom: 1px solid #000; letter-spacing: 10px;'>TERMS</td></tr>
                            <tr><td width='100%' height='10px'></td></tr>
                            <tr><td width='100%' align='center'>NET 14 Days. Finance Charge of 4% will be made on unpaid balances after 14 days.</td></tr>
                          </tbody>
                        </table>
                        </td></tr></tbody></table></td></tr></tbody></table></body></html>";

      $mail->send();

  } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }

  unset($_SESSION['cart']);
  $_SESSION['purchase'] = "Thank you for your purchase! Your order number is .'$newOrder'. . we'd love to hear your feedback.";
  header('Location: '.BASE_URL.'index.php');
}
}

//echo'<pre>';print_r($cart);die;  $balanceDue = $totalPriceForProduct * lenght($totalPriceForProduct);

require (ROOT_PATH . '/view/elements/head_section.php');
?>

<style>
    .hidden{
        display:none;
    }

</style>

<div class="container bg-white">
  <div class="py-5 text-center">
    <img class="d-block mx-auto mb-4" src="" alt="" width="72" height="40">
    <h2>Checkout</h2>
  </div>

  <div class="row">
    <div class="col-md-4 order-md-2 mb-4">
      <h4 class="d-flex justify-content-between align-items-center mb-3">
        <span class="text-muted">Your cart</span>
        <span class="badge badge-secondary badge-pill"> Number of Items (<?= $cartItems ?>)</span>
      </h4>
      <ul class="list-group mb-3">
            <?php foreach ($cart as $cartProduct) { 
              $priceWithDiscount= $cartProduct->getPrice()- ($cartProduct->getPrice()*$cartProduct->getDiscount()/100);
              ?>
        <li class="list-group-item d-flex justify-content-between lh-condensed">
        <div>
            <h6 class="my-0"><?= $cartProduct->getTitle() ?></h6>
            <small class="text-muted">Quantity (<?= $cartProduct->getQuantity() ?>)</small>
        </div>
        <span class="text-muted"><?= number_format($cartProduct->getQuantity() * $priceWithDiscount , 2) ?>€</span>
        </li>
            <?php } ?>

        <li class="list-group-item d-flex justify-content-between bg-light">
          <div class="text-success">
            <h6 class="my-0"></h6>
            <small></small>
          </div>
          <span class="text-success"></span>
        </li>
        <li class="list-group-item d-flex justify-content-between">
          <span>Total (EUR)</span>
          <strong><?= number_format($cartTotalPrice ,2) ?> €</strong>
        </li>
      </ul>

      <h4 class="mb-3">Payment</h4>

        <div class="d-block my-3">
            <div class="custom-control custom-radio">
                <input id="credit" name="paymentMethod" type="checkbox" class="custom-control-input" >
                <label class="custom-control-label" for="credit">Credit card</label>
            </div>

            <div class="custom-control custom-radio">
                <input id="paypal" name="paymentMethod" type="checkbox" class="custom-control-input" >
                <label class="custom-control-label" for="paypal">PayPal</label>
            </div>
        </div>
            <div class="row">
                <!-- Credit card . -->
                <div class="form-row hidden credit" style="">
                    <?php include(ROOT_PATH . '/view/main/cart/payment/payment.html') ?>
                </div>
                <!-- paypal . -->
                <div class="form-row hidden paypal" style="">
                    <?php include(ROOT_PATH . '/view/main/cart/payment/paypal.php') ?>
                </div>
            </div>

    </div>

    <div class="col-md-8 order-md-1">
      <h4 class="mb-3">Billing address</h4>
      
      <?php  foreach($errors as $error){ ?>
          <p class="text-danger bg-warning"><?= $error ?></p>
      <?php } ?>

      <form class="needs-validation" action="" method="POST" novalidate="" id="payment-form">

        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="firstName">First name</label>
            <input type="text" class="form-control" id="firstName" name="firstName" value="<?=$_SESSION['user']->getFirstname()?>" required="">
            <div class="invalid-feedback">
              Valid first name is required.
            </div>
          </div>
          <div class="col-md-6 mb-3">
            <label for="lastName">Last name</label>
            <input type="text" class="form-control" id="lastName" name="lastName" value="<?=$_SESSION['user']->getLastname()?>" required="">
            <div class="invalid-feedback">
              Valid last name is required.
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="email">Email</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">@</span>
              </div>
              <input type="email" class="form-control" id="email" name="email" placeholder="you@example.com" required="" value="<?=$_SESSION['user']->getEmail()?>">
              <div class="invalid-feedback" style="width: 100%;">
                  Please enter a valid email address for shipping updates.
              </div>
            </div>
          </div>
          <div class="col-md-6 mb-3 mt-3">
            <label for="telephone">Telephone Number</label>
            <input type="number" class="form-control" id="telephone" name="telephone" value=""  min="8" max="12">
            <div class="invalid-feedback">
              Valid Telephone Number is required.
            </div>
          </div>
        </div>
        
        <div class="row">
          <div class="col-md-5 mb-3">
            <label for="country">Country</label>
            <select id="country" name="country" class="form-control">
                <option value="">Choose...</option>
                <?php 
                  if(!empty($userAddress)){ ?>
                    <option value="<?=$userAddress->getCountry()?>" selected><?=$userAddress->getCountry()?></option>
                <?php } ?>
                <option value="Afghanistan">Afghanistan</option>
                <option value="Åland Islands">Åland Islands</option>
                <option value="Albania">Albania</option>
                <option value="Algeria">Algeria</option>
                <option value="American Samoa">American Samoa</option>
                <option value="Andorra">Andorra</option>
                <option value="Angola">Angola</option>
                <option value="Anguilla">Anguilla</option>
                <option value="Antarctica">Antarctica</option>
                <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                <option value="Argentina">Argentina</option>
                <option value="Armenia">Armenia</option>
                <option value="Aruba">Aruba</option>
                <option value="Australia">Australia</option>
                <option value="Austria">Austria</option>
                <option value="Azerbaijan">Azerbaijan</option>
                <option value="Bahamas">Bahamas</option>
                <option value="Bahrain">Bahrain</option>
                <option value="Bangladesh">Bangladesh</option>
                <option value="Barbados">Barbados</option>
                <option value="Belarus">Belarus</option>
                <option value="Belgium">Belgium</option>
                <option value="Belize">Belize</option>
                <option value="Benin">Benin</option>
                <option value="Bermuda">Bermuda</option>
                <option value="Bhutan">Bhutan</option>
                <option value="Bolivia">Bolivia</option>
                <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                <option value="Botswana">Botswana</option>
                <option value="Bouvet Island">Bouvet Island</option>
                <option value="Brazil">Brazil</option>
                <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
                <option value="Brunei Darussalam">Brunei Darussalam</option>
                <option value="Bulgaria">Bulgaria</option>
                <option value="Burkina Faso">Burkina Faso</option>
                <option value="Burundi">Burundi</option>
                <option value="Cambodia">Cambodia</option>
                <option value="Cameroon">Cameroon</option>
                <option value="Canada">Canada</option>
                <option value="Cape Verde">Cape Verde</option>
                <option value="Cayman Islands">Cayman Islands</option>
                <option value="Central African Republic">Central African Republic</option>
                <option value="Chad">Chad</option>
                <option value="Chile">Chile</option>
                <option value="China">China</option>
                <option value="Christmas Island">Christmas Island</option>
                <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
                <option value="Colombia">Colombia</option>
                <option value="Comoros">Comoros</option>
                <option value="Congo">Congo</option>
                <option value="Congo, The Democratic Republic of The">Congo, The Democratic Republic of The</option>
                <option value="Cook Islands">Cook Islands</option>
                <option value="Costa Rica">Costa Rica</option>
                <option value="Cote D'ivoire">Cote D'ivoire</option>
                <option value="Croatia">Croatia</option>
                <option value="Cuba">Cuba</option>
                <option value="Cyprus">Cyprus</option>
                <option value="Czech Republic">Czech Republic</option>
                <option value="Denmark">Denmark</option>
                <option value="Djibouti">Djibouti</option>
                <option value="Dominica">Dominica</option>
                <option value="Dominican Republic">Dominican Republic</option>
                <option value="Ecuador">Ecuador</option>
                <option value="Egypt">Egypt</option>
                <option value="El Salvador">El Salvador</option>
                <option value="Equatorial Guinea">Equatorial Guinea</option>
                <option value="Eritrea">Eritrea</option>
                <option value="Estonia">Estonia</option>
                <option value="Ethiopia">Ethiopia</option>
                <option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
                <option value="Faroe Islands">Faroe Islands</option>
                <option value="Fiji">Fiji</option>
                <option value="Finland">Finland</option>
                <option value="France">France</option>
                <option value="French Guiana">French Guiana</option>
                <option value="French Polynesia">French Polynesia</option>
                <option value="French Southern Territories">French Southern Territories</option>
                <option value="Gabon">Gabon</option>
                <option value="Gambia">Gambia</option>
                <option value="Georgia">Georgia</option>
                <option value="Germany">Germany</option>
                <option value="Ghana">Ghana</option>
                <option value="Gibraltar">Gibraltar</option>
                <option value="Greece">Greece</option>
                <option value="Greenland">Greenland</option>
                <option value="Grenada">Grenada</option>
                <option value="Guadeloupe">Guadeloupe</option>
                <option value="Guam">Guam</option>
                <option value="Guatemala">Guatemala</option>
                <option value="Guernsey">Guernsey</option>
                <option value="Guinea">Guinea</option>
                <option value="Guinea-bissau">Guinea-bissau</option>
                <option value="Guyana">Guyana</option>
                <option value="Haiti">Haiti</option>
                <option value="Heard Island and Mcdonald Islands">Heard Island and Mcdonald Islands</option>
                <option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option>
                <option value="Honduras">Honduras</option>
                <option value="Hong Kong">Hong Kong</option>
                <option value="Hungary">Hungary</option>
                <option value="Iceland">Iceland</option>
                <option value="India">India</option>
                <option value="Indonesia">Indonesia</option>
                <option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option>
                <option value="Iraq">Iraq</option>
                <option value="Ireland">Ireland</option>
                <option value="Isle of Man">Isle of Man</option>
                <option value="Israel">Israel</option>
                <option value="Italy">Italy</option>
                <option value="Jamaica">Jamaica</option>
                <option value="Japan">Japan</option>
                <option value="Jersey">Jersey</option>
                <option value="Jordan">Jordan</option>
                <option value="Kazakhstan">Kazakhstan</option>
                <option value="Kenya">Kenya</option>
                <option value="Kiribati">Kiribati</option>
                <option value="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option>
                <option value="Korea, Republic of">Korea, Republic of</option>
                <option value="Kuwait">Kuwait</option>
                <option value="Kyrgyzstan">Kyrgyzstan</option>
                <option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option>
                <option value="Latvia">Latvia</option>
                <option value="Lebanon">Lebanon</option>
                <option value="Lesotho">Lesotho</option>
                <option value="Liberia">Liberia</option>
                <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
                <option value="Liechtenstein">Liechtenstein</option>
                <option value="Lithuania">Lithuania</option>
                <option value="Luxembourg">Luxembourg</option>
                <option value="Macao">Macao</option>
                <option value="Macedonia, The Former Yugoslav Republic of">Macedonia, The Former Yugoslav Republic of</option>
                <option value="Madagascar">Madagascar</option>
                <option value="Malawi">Malawi</option>
                <option value="Malaysia">Malaysia</option>
                <option value="Maldives">Maldives</option>
                <option value="Mali">Mali</option>
                <option value="Malta">Malta</option>
                <option value="Marshall Islands">Marshall Islands</option>
                <option value="Martinique">Martinique</option>
                <option value="Mauritania">Mauritania</option>
                <option value="Mauritius">Mauritius</option>
                <option value="Mayotte">Mayotte</option>
                <option value="Mexico">Mexico</option>
                <option value="Micronesia, Federated States of">Micronesia, Federated States of</option>
                <option value="Moldova, Republic of">Moldova, Republic of</option>
                <option value="Monaco">Monaco</option>
                <option value="Mongolia">Mongolia</option>
                <option value="Montenegro">Montenegro</option>
                <option value="Montserrat">Montserrat</option>
                <option value="Morocco">Morocco</option>
                <option value="Mozambique">Mozambique</option>
                <option value="Myanmar">Myanmar</option>
                <option value="Namibia">Namibia</option>
                <option value="Nauru">Nauru</option>
                <option value="Nepal">Nepal</option>
                <option value="Netherlands">Netherlands</option>
                <option value="Netherlands Antilles">Netherlands Antilles</option>
                <option value="New Caledonia">New Caledonia</option>
                <option value="New Zealand">New Zealand</option>
                <option value="Nicaragua">Nicaragua</option>
                <option value="Niger">Niger</option>
                <option value="Nigeria">Nigeria</option>
                <option value="Niue">Niue</option>
                <option value="Norfolk Island">Norfolk Island</option>
                <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                <option value="Norway">Norway</option>
                <option value="Oman">Oman</option>
                <option value="Pakistan">Pakistan</option>
                <option value="Palau">Palau</option>
                <option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option>
                <option value="Panama">Panama</option>
                <option value="Papua New Guinea">Papua New Guinea</option>
                <option value="Paraguay">Paraguay</option>
                <option value="Peru">Peru</option>
                <option value="Philippines">Philippines</option>
                <option value="Pitcairn">Pitcairn</option>
                <option value="Poland">Poland</option>
                <option value="Portugal">Portugal</option>
                <option value="Puerto Rico">Puerto Rico</option>
                <option value="Qatar">Qatar</option>
                <option value="Reunion">Reunion</option>
                <option value="Romania">Romania</option>
                <option value="Russian Federation">Russian Federation</option>
                <option value="Rwanda">Rwanda</option>
                <option value="Saint Helena">Saint Helena</option>
                <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                <option value="Saint Lucia">Saint Lucia</option>
                <option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
                <option value="Saint Vincent and The Grenadines">Saint Vincent and The Grenadines</option>
                <option value="Samoa">Samoa</option>
                <option value="San Marino">San Marino</option>
                <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                <option value="Saudi Arabia">Saudi Arabia</option>
                <option value="Senegal">Senegal</option>
                <option value="Serbia">Serbia</option>
                <option value="Seychelles">Seychelles</option>
                <option value="Sierra Leone">Sierra Leone</option>
                <option value="Singapore">Singapore</option>
                <option value="Slovakia">Slovakia</option>
                <option value="Slovenia">Slovenia</option>
                <option value="Solomon Islands">Solomon Islands</option>
                <option value="Somalia">Somalia</option>
                <option value="South Africa">South Africa</option>
                <option value="South Georgia and The South Sandwich Islands">South Georgia and The South Sandwich Islands</option>
                <option value="Spain">Spain</option>
                <option value="Sri Lanka">Sri Lanka</option>
                <option value="Sudan">Sudan</option>
                <option value="Suriname">Suriname</option>
                <option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
                <option value="Swaziland">Swaziland</option>
                <option value="Sweden">Sweden</option>
                <option value="Switzerland">Switzerland</option>
                <option value="Syrian Arab Republic">Syrian Arab Republic</option>
                <option value="Taiwan, Province of China">Taiwan, Province of China</option>
                <option value="Tajikistan">Tajikistan</option>
                <option value="Tanzania, United Republic of">Tanzania, United Republic of</option>
                <option value="Thailand">Thailand</option>
                <option value="Timor-leste">Timor-leste</option>
                <option value="Togo">Togo</option>
                <option value="Tokelau">Tokelau</option>
                <option value="Tonga">Tonga</option>
                <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                <option value="Tunisia">Tunisia</option>
                <option value="Turkey">Turkey</option>
                <option value="Turkmenistan">Turkmenistan</option>
                <option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
                <option value="Tuvalu">Tuvalu</option>
                <option value="Uganda">Uganda</option>
                <option value="Ukraine">Ukraine</option>
                <option value="United Arab Emirates">United Arab Emirates</option>
                <option value="United Kingdom">United Kingdom</option>
                <option value="United States">United States</option>
                <option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
                <option value="Uruguay">Uruguay</option>
                <option value="Uzbekistan">Uzbekistan</option>
                <option value="Vanuatu">Vanuatu</option>
                <option value="Venezuela">Venezuela</option>
                <option value="Viet Nam">Viet Nam</option>
                <option value="Virgin Islands, British">Virgin Islands, British</option>
                <option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option>
                <option value="Wallis and Futuna">Wallis and Futuna</option>
                <option value="Western Sahara">Western Sahara</option>
                <option value="Yemen">Yemen</option>
                <option value="Zambia">Zambia</option>
                <option value="Zimbabwe">Zimbabwe</option>
            </select>
            <div class="invalid-feedback">
              Please select a valid country.
            </div>
          </div>
          <div class="col-md-4 mb-3">
            <label for="state">State</label>
            <input 
                type="text" 
                class="form-control" 
                name="state" 
                id="state" 
                placeholder="" 
                required="" 
                value ="<?= (!empty($userAddress)) ?  $userAddress->getState() :  '' ;?>"
                />
            <div class="invalid-feedback">
              Please provide a valid state.
            </div>
          </div>
          <div class="col-md-3 mb-3">
            <label for="zip">Zip</label>
            <input 
                type="text" 
                class="form-control" 
                name="zip" 
                id="zip" 
                placeholder="" 
                required=""
                value ="<?= (!empty($userAddress)) ?  $userAddress->getZip() :  '' ;?>"
                />
            <div class="invalid-feedback">
              Zip code required.
            </div>
          </div>
        </div>

        <div class="mb-3">
          <label for="address">Address</label>
          <input 
                type="text" 
                class="form-control" 
                id="address"  
                name="address" 
                placeholder="Street  Nr.Hose" 
                required=""
                value="<?= (!empty($userAddress)) ?  $userAddress->getAddress() :  '' ;?>"
                />
          <div class="invalid-feedback">
            Please enter your shipping address.
          </div>
        </div>
        <br>
        <hr class="mb-4">
        <div class="custom-control custom-radio">
          <input type="checkbox" class="custom-control-input" id="same-address" style="margin-left:10px!important">
          <label class="custom-control-label" for="same-address">Shipping address is the same as my billing address</label>
        </div>
        
        <input type="submit" class="btn btn-primary btn-lg btn-block mt-4" name="submit" value="Continue to checkout" />
      </form>

      

    </div>
  </div>
  <br><br>
</div>

<script>
$(document).ready(function(){  
    $("#credit").click(function(){  
        $(".credit").toggleClass("hidden");
        $(".paypal").addClass("hidden");
        $("#paypal").prop('checked', false);
    });  
    $("#paypal").click(function(){  
        $(".paypal").toggleClass("hidden");
        $(".credit").addClass("hidden");
        $("#credit").prop('checked', false);
    });  
});  
</script>
<script>
// Example starter JavaScript for disabling form submissions if there are invalid fields
(function () {
  'use strict'

  window.addEventListener('load', function () {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation')

    // Loop over them and prevent submission
    Array.prototype.filter.call(forms, function (form) {
      form.addEventListener('submit', function (event) {
        if (form.checkValidity() === false) {
          event.preventDefault()
          event.stopPropagation()
        }
        form.classList.add('was-validated')
      }, false)
    })
  }, false)
}())

</script>




<?php include(ROOT_PATH . '/view/elements/footer.php') ?>
