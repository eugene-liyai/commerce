<?php require_once("../resources/config.php"); ?>
<?php include(TEMPLATE_FRONT . DS . "header.php") ?>

<!-- Page Content -->
<div class="container">


<!-- /.row --> 

<div class="row">
	<?php if(isset($_SESSION['message'])): ?>
      <h5 class="text-center bg-danger"><?php display_message(); ?></h5>
    <?php endif; ?>
    <h1>Checkout</h1>

    <?php 

    if(isset($_SESSION['product_1'])) {
    	echo $_SESSION['product_1'];
    }

    ?>

<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_cart">
<input type="hidden" name="business" value="edwindiaz123-facilitator@gmail.com">
<input type="hidden" name="currency_code" value="US">
    <table class="table table-striped">
        <thead>
          <tr>
           <th>Product</th>
           <th>Price</th>
           <th>Quantity</th>
           <th>Sub-total</th>
     
          </tr>
        </thead>
        <tbody>
          <?php //cart(); ?>
          <tr>
          	<td>apple</td>
          	<td>$23</td>
          	<td>3</td>
          	<td>2</td>
          	<td><a class="btn btn-info" href="cart.php?add=1">add</a></td>
          	<td><a class="btn btn-warning" href="cart.php?remove=1">remove</a></td>
          	<td><a class="btn btn-danger" href="cart.php?delete=1">delete</a></td>
          </tr>
        </tbody>
    </table>
  <?php //echo show_paypal(); ?>
</form>



<!--  ***********CART TOTALS*************-->
            
<div class="col-xs-4 pull-right ">
<h2>Cart Totals</h2>

<table class="table table-bordered" cellspacing="0">

<tr class="cart-subtotal">
<th>Items:</th>
<td><span class="amount"><?php 
// echo isset($_SESSION['item_quantity']) ? $_SESSION['item_quantity'] : $_SESSION['item_quantity'] = "0";?></span></td>
</tr>
<tr class="shipping">
<th>Shipping and Handling</th>
<td>Free Shipping</td>
</tr>

<tr class="order-total">
<th>Order Total</th>
<td><strong><span class="amount">KES <?php 
//echo isset($_SESSION['item_total']) ? $_SESSION['item_total'] : $_SESSION['item_total'] = "0";?>



</span></strong> </td>
</tr>


</tbody>

</table>

</div><!-- CART TOTALS-->


 </div><!--Main Content-->

</div>
<!-- /.container -->



<?php include(TEMPLATE_FRONT . DS . "footer.php") ?>
