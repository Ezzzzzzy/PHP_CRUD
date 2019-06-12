<?php
//including the database connection file
session_start();
include_once("classes/Product.php");
include_once("classes/Cart.php");
include_once("classes/Rate.php");
$products = new Product();
$products = $products->getProducts(); 
$cartItems = new Cart();
$cartItems = $cartItems->getCart();
$user = new Cart();
$user = $user->getUser();
$rate = new Rate();
?>
 
<html>
<head>    
    <title>Homepage</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"rel="stylesheet">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Font Awesome -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
<!-- Bootstrap core CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
<!-- Material Design Bootstrap -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.2/css/mdb.min.css" rel="stylesheet">
</head>
<style>  
.list-group-item:last-child {
    margin-bottom: 0;
    border-bottom-right-radius: 0rem;
    border-bottom-left-radius: 0rem;
}
.list-group-item:first-child {
    border-top-left-radius: 0rem;
    border-top-right-radius: 0rem;
}
</style>
<body>
    
    <div class="container">
        <div class="row">
            <div class="col-8">
                        <div class="list-group">
                        <div class="list-group-item bg-light" ><h3>Products</h3></div>
                        </div>
            <!-- <div class="modal fade" id="basicExampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content text-center">
                <div class="modal-body">
                <span id="rateMe">
                    <i class="fas fa-star py-2 px-1 rate-popover" data-index="0" data-html="true" data-toggle="popover" data-placement="top" title="Very bad"></i>
                    <i class="fas fa-star py-2 px-1 rate-popover" data-index="1" data-html="true" data-toggle="popover" data-placement="top" title="Poor"></i>
                    <i class="fas fa-star py-2 px-1 rate-popover" data-index="2" data-html="true" data-toggle="popover" data-placement="top" title="OK"></i>
                    <i class="fas fa-star py-2 px-1 rate-popover" data-index="3" data-html="true" data-toggle="popover" data-placement="top" title="Good"></i>
                    <i class="fas fa-star py-2 px-1 rate-popover" data-index="4" data-html="true" data-toggle="popover" data-placement="top" title="Excellent"></i>
                    </span>  
                </div>
                </div>
            </div>
            </div> -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
               
                <div class="modal-body text-center">
                    <span id="rateMe">
                    <i class="fas fa-star py-2 px-1 rate-popover" data-index="0" data-html="true" data-toggle="popover" data-placement="top" title="Very bad"></i>
                    <i class="fas fa-star py-2 px-1 rate-popover" data-index="1" data-html="true" data-toggle="popover" data-placement="top" title="Poor"></i>
                    <i class="fas fa-star py-2 px-1 rate-popover" data-index="2" data-html="true" data-toggle="popover" data-placement="top" title="OK"></i>
                    <i class="fas fa-star py-2 px-1 rate-popover" data-index="3" data-html="true" data-toggle="popover" data-placement="top" title="Good"></i>
                    <i class="fas fa-star py-2 px-1 rate-popover" data-index="4" data-html="true" data-toggle="popover" data-placement="top" title="Excellent"></i>
                    </span> 
                    <input type="hidden" name="product_id_modal" value=""> 
                </div>
                </div>
            </div>
            </div>
                  
                        <?php foreach ($products  as $key => $res) {?>
                            
                                <div class="list-group-item">
                                 <div class="row no-gutters">
                                    <div class="col-md-4">
                                        <img src="<?= $res['image']?>" class="img-responsive mx-auto d-block" width="180" height="200">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body"> 
                                            <p class="card-text float-right text-warning">$<?= $res['price'] ?></p>
                                            <h5 class="card-title "><?= $res['name'] ?></h5>
                                            <p class="card-text"><?= $res['description'] ?></p>
                                            <form action="ajax/add.php" name="product" id="product" method="POST">
                                                <div class="form-row align-items-center">
                                                    <div class="col-auto my-1">
                                                    <label class="mr-sm-2 sr-only" for="inlineFormCustomSelect">Preference</label>
                                                    <input class="custom-select mr-sm-2" value=1 name="quantity" id="quantity"/>
                                                    <input type="hidden" value=<?=$res['id']?> name="id">
                                                    </div>
                                                    <div class="col-auto my-1">
                                                    <button type="submit"  class="btn btn-light">Add to Cart</button>
                                                    <button type="button"  <?php echo isset($_SESSION["product".$res['id']]) ? 'disabled' : '' ?> data-toggle="modal" data-productid="<?=$res['id']?>" data-target="#exampleModal" class="btn btn-warning px-3"><i class="fas fa-star" aria-hidden="true"></i> Rate Me</button>                      
                                                    <button disabled class="btn btn-outline-warning waves-effect px-3"><i class="fas fa-star" aria-hidden="true"></i> <?= $rate->getRate($res['id'])?></button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        <?php } ?>
                        </div>                    
            <div class="col-4">
                            
                <div class="list-group ">
                    <div class="list-group-item text-white bg-dark"><h3>CART SUMMARY</h3></div>
                    <div class="list-group-item text-white bg-dark"> 
                        <p class="float-right"> $<?=$user['credits']?></p>
                        <p>User credits:</p>
                    </div>
                    <div class="list-group-item text-white bg-dark"> 
                        <p>Items</p>
                        <?php foreach($cartItems as $res){ ?>
                            <div class="float-right">$<?= $res['product_total'] ?></div>
                            <div class="col-8">
                                <button type="button"
                                    class="close text-light float-left px-1"
                                    aria-label="Close"
                                    onclick="location.href='ajax/delete.php?id=<?= $res['id'] ?>'">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <div class="mr-3"><?= $res['product_name'] ?> x  <?= $res['quantity'] ?></div> 
                            </div>
                             
                        <?php } ?>
                    </div>

                    
                    <div class="list-group-item text-white bg-dark">
                    <form action="ajax/checkout.php" method="POST">
                        <p>Shipping method<p>
                        <div class="float-right">
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="ups">
                        <label class="form-check-label" for="inlineRadio1">
                            <span class="material-icons">
                                verified_user
                            </span>UPS<small> $5</small>
                        </label>
                        
                        </div>

                        <div class="float-left col-6">
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="pickup">
                        <span class="material-icons">
                            directions_run
                        </span>PICK UP <small> FREE</small>
                        </div>
                        <p></p>
                    </div>        
                    <div class="list-group-item text-white bg-dark">
                        <div class="float-right" id="total">$
                            <?php
                            $cartItems = new Cart();
                            echo $cartItems->getTotal();
                            ?>
                        </div>
                        <p>Total</p>
                    </div>        
                    <div class="list-group-item text-white bg-dark">
                        <button type="submit" class="btn btn-warning btn-lg btn-block">Checkout</button>
                        </form>
                    </div>        
                                        
                </div>
            
            </div>
        </div>
    </div>

<?php session_abort();?>
       
</body>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="ajax/ajax.js"></script>
<script src="js/rating.js"></script> 
<script>
$("#exampleModal").on('show.bs.modal', function(e){
  var userid = $(e.relatedTarget).data('productid');
  $(e.currentTarget).find('input[name="product_id_modal"]').val(userid);
});

$(document).ready(function(){
    var product_id = document.getElementsByName("product_id_modal").value 
  $('.rate-popover').popover({
    // Append popover to #rateMe to allow handling form inside the popover
    container: '#rateMe',
    // Custom content for popover
    content: `<button id="voteSubmitButton" type="submit" class="btn btn-sm btn-primary">Submit!</button>`
  });
  $('.rate-popover').tooltip();
});
</script>
</html>