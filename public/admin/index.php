<?php require_once("../../resources/config.php"); ?>
<?php include(TEMPLATE_BACK . DS . 'header.php'); ?>

<?php 
    if(!isset($_SESSION['username'])) {
        redirect("../../public/login.php");
    }
?>
    
    <div id="page-wrapper">

        <div class="container-fluid">
            <?php 

                if ($_SERVER['REQUEST_URI'] == getenv('PATH_TO_ADMIN')
                    || $_SERVER['REQUEST_URI'] == getenv('PATH_TO_ADMIN'). 'index.php') {
                    include(TEMPLATE_BACK . DS . 'admin_content.php');
                }

                if(isset($_GET['orders'])){
                    include(TEMPLATE_BACK . DS . 'order.php');
                }

                if(isset($_GET['categories'])){
                    include(TEMPLATE_BACK . DS . 'categories.php');
                }

                 if(isset($_GET['products'])){
                    include(TEMPLATE_BACK . DS . 'products.php');
                }

                 if(isset($_GET['add_product'])){
                    include(TEMPLATE_BACK . DS . 'add_product.php');
                }


                //  if(isset($_GET['edit_product'])){
                //     include(TEMPLATE_BACK . "/edit_product.php");
                // }

                // if(isset($_GET['users'])){
                //     include(TEMPLATE_BACK . "/users.php");
                // }


                // if(isset($_GET['add_user'])){
                //     include(TEMPLATE_BACK . "/add_user.php");
                // }


                //  if(isset($_GET['edit_user'])){
                //     include(TEMPLATE_BACK . "/edit_user.php");
                // }


                //   if(isset($_GET['reports'])){
                //     include(TEMPLATE_BACK . "/reports.php");
                // }

            ?>
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->

<?php include(TEMPLATE_BACK . DS . 'footer.php'); ?>
