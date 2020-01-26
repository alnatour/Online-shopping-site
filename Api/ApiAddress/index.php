<?php

require '../../include.php';

$apiaddress= new ApiAddress2($url, $username, $password);

// INIT
$Search='';
$data = false;

$xml = $apiaddress->getAllAddresses($fields);
if (!$xml) {

    $feedback = $apiaddress->getLastErrorMessage();

} else {

    // view  value for all fields address from curl
    $data = array();
    foreach ($xml->data->address as $address) {

        $attributes = $address->attributes();

        $item = array();
        $item['id'] = (int)$attributes['id'];
        foreach ($fields as $field) {
            // select item by Id
            $item[$field] = (string)$address->{$field};
        }

        $data[] = $item;
    }

   // echo '<pre>';print_r($item);die;
}

require '../../header.php';

?>


<?php if ($data) { ?>

<div class="parallax-contact"></div>
<div class="parallax-contact">

<div class="container table-responsive" style="background-color:#fff">
    <div class="table-wrapper mt-4 mb-0">  

        <div class="table-title">
            <div class="row">
                <div class="col">
                    <h2>Kontakte <b> verwalten</b></h2>
                </div>
                <div class="col">
                        <div>
                            <form method="post" action="index.php" class="form-inline"> 
                                <input type="text" name="Search" class="form-control mr-sm-0" value="<?=$Search;?>">
                                <input type="submit" name="submit_search" value="Search" class="btn btn-outline-success btn-rounded btn-sm my-1" />
                            </form>
                        </div>		
                </div>
                <div class="col">
            
                    <a href="insert_new_address.php" class="btn btn-success btn-md" ><i class="fa fa-plus-circle"></i><span>Add New</span></a>

                </div>
            </div>
        </div>

        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th >Vorname</th>
                    <th>Nachname</th>
                    <th>Email</th>
                    <th class='hidden'>Phone</th>
           
                    <th width="100%" style="text-align:right;">Actions</th>

                </tr>
            </thead>
            <tbody> 
            <?php foreach ($data as $object) { ?>
                <tr>
                <td><?= $object['firstname']; ?></td>
                    <td><?= $object['lastname']; ?></td>
                    <td><?= $object['email']; ?></td>
                    <td><?= $object['phone']; ?></td>
                    <td style="white-space:nowrap;" align="right" width="100%">
                        <a href="view_one_address.php?id=<?= $object['id']; ?>" ><i class="material-icons text-info" title="View">&#xe0ba;</i></a>
                        <a href="edit.php?id=<?= $object['id']; ?>" ><i class="material-icons text-warning" title="Edit">&#xE254;</i></a>
                        <a href="delete.php?id=<?= $object['id']; ?>"  ><i class="material-icons text-danger" title="Delete">&#xE872;</i></a>
                    </td>
      
                </tr>

                    <?php } ?>
            </tbody>
        </table>
        </div>
	</div>
</div>


<div class="parallax-contact"></div>
<?php } ?>


 <?php
require '../../footer.php';
