<?php

require '../../config.php';
require (ROOT_PATH . '/controlle/admin/admin_session.php');
require (ROOT_PATH . '/view/elements/head_section.php');

$articles_db = ArticleDb::getInstance();
$comments_db = ReviewsDb::getInstance();
$users_db = ContactDb::getInstance();

$count_articles = count($articles_db->GetAllArtikels());
$count_comments = count($comments_db->GetAllComment());
$count_users = $users_db->CountAllAddress();


?>

<br><br>

<h3 align="right">Welcome <?= $_SESSION['user']->getFirstname()?> <?= $_SESSION['user']->getLastname()?></h3>
<div class="container-fluid content bg-white">
    <div class="row">
        <!-- menu -->
        <div class="col-md-3  menu bg-dark">
            <div class="card">
                <div class="card-header">
                    <h2>Actions</h2>
                </div>
                <div class="card-content">
                    <a href="<?php echo BASE_URL . 'view/admin/admin_panel.php' ?>">Manage Articles</a>
                    <a href="<?php echo BASE_URL . 'view/admin/users/users_view.php' ?>">Manage Users</a>
                    <a href="<?php echo BASE_URL . 'view/admin/topics/topics_view.php' ?>">Manage Topics</a>
                    <a href="<?php echo BASE_URL . 'view/admin/reviews/reviews_view.php' ?>" > Manage Reviews</a>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="row">
                <!-- article -->
                <div class="col  menu">
                    <div class="card cart-responsive ">
                        <div class="card-body bg-success p-2 text-white">
                            <div class="row">
                                <div class="col-3">
                                    <i class="fa fa-product-hunt fa-5x"></i>
                                </div>
                                <div class="col-9 text-right">
                                    <div><?=$count_articles?></div>
                                    <div>Articles!</div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card-footer">
                            <div class="row"> 
                                <div class=" text-primary" style="width:50%; float:left">
                                    <span>
                                        View Details
                                    </span>
                                </div>

                                <div align="right" style="width:50%;">
                                    <a href="<?php echo BASE_URL . 'view/admin/admin_panel.php' ?>" class="btn btn-sm btn-outline-success">
                                        <i class="fa fa-arrow-circle-right"></i> 
                                    </a>
                                </div>
                            </div>
                            
                        </div>
                        
                    </div>
                </div>
                <!-- Comment-->
                <div class="col menu" >
                    <div class="card cart-responsive ">
                        <div class="card-body bg-warning p-2 text-white">
                            <div class="row">
                                <div class="col-3">
                                    <i class="fa fa-comments fa-5x"></i>
                                </div>
                                <div class="col-9 text-right">
                                    <div><?=$count_comments?></div>
                                    <div>Rerviews & Comments!</div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card-footer">
                            <div class="row"> 
                                <div class=" text-primary" style="width:50%; float:left">
                                    <span>
                                        View Details
                                    </span>
                                </div>

                                <div align="right" style="width:50%;">
                                    <a href="<?php echo BASE_URL . 'view/admin/reviews/reviews_view.php' ?>" class="btn btn-sm btn-outline-warning">
                                        <i class="fa fa-arrow-circle-right"></i> 
                                    </a>
                                </div>
                            </div>
                            
                        </div>
                        
                    </div>
                </div>
                <!-- Users-->
                <div class="col  menu" >
                    <div class="card cart-responsive ">
                        <div class="card-body bg-primary p-2 text-white">
                            <div class="row">
                                <div class="col-3">
                                    <i class="fa fa-address-book fa-5x"></i>
                                </div>
                                <div class="col-9 text-right">
                                    <div><?=$count_users?></div>
                                    <div>Users!</div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card-footer">
                            <div class="row"> 
                                <div class=" text-primary" style="width:50%; float:left">
                                    <span>
                                        View Details
                                    </span>
                                </div>

                                <div align="right" style="width:50%;">
                                    <a href="<?php echo BASE_URL . 'view/admin/users/users_view.php' ?>" class="btn btn-sm btn-outline-primary">
                                        <i class="fa fa-arrow-circle-right"></i> 
                                    </a>
                                </div>
                            </div>
                            
                        </div>
                        
                    </div>
                </div>
            </div>
            <!-- Visitor -->
            <div class="row">
                <div class="col-md-3 offset-md-9 menu" >
                    <div class="card cart-responsive ">
                        <div class="card-body bg-danger p-2 text-white">
                            <div class="row mt-2">
                                <div class="col-12 text-center">
                                    <i class="fa fa-eye fa-5x"></i>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-12 text-center">
                                    <div style="font-size: 2.5rem;">
                                    <?= $counter?> </div>
                                    <div>Total Views</div>
                                    <div>Visitors</div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>

            <!-- Active Users -->
            <div class="row">
                <div class="card-header">Active Users</div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">First</th>
                        <th scope="col">Last</th>
                        <th scope="col">Handle</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                        </tr>
                        <tr>
                        <th scope="row">2</th>
                        <td>Jacob</td>
                        <td>Thornton</td>
                        <td>@fat</td>
                        </tr>
                        <tr>
                        <th scope="row">3</th>
                        <td>Larry</td>
                        <td>the Bird</td>
                        <td>@twitter</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<div style="height:50px"></div>
<?php include(ROOT_PATH . '/view/elements/footer.php') ?>
