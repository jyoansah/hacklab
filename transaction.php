<?php

    include('header.php');
    $_SESSION["login_user"]= "1";

?>

    <div class="dashboard container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
            <li><a href="dashboard.php">Overview <span class="sr-only">(current)</span></a></li>
            <li class="active"><a href="#">Make a Payment</a></li>
            <li><a href="loan.php">Apply for a Loan</a></li>
            <!-- <li><a href="#">Loan</a></li> -->
          </ul>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Transaction</h1>

          <div class="row placeholders">
            <div class="col-xs-6 col-sm-6 amount">
              <span class="text-muted">You currently owe:</span>
              <h1>GH₵ <?php echo $user->getBalance();?></h1>
            </div>
            <div class="col-xs-6 col-sm-6 amount">
              <span class="text-muted">Your slidepay balance:</span>
              <h1>GH₵ <?php echo $user->getBalance();?></h1>
            </div>
          </div>

          <br>
          <h2 class="sub-header">Make the payment:</h2>
          <br>
          <div class="table-responsive">
            
            <form id="login-form" action="api/payments.php" method="post" role="form" style="display: block;">
              <div class="col-xs-2 col-sm-2">
                <h1>GH₵</h1>
              </div>
              <div class="form-group col-xs-6 col-sm-6 paybox ">
                    <input type="text" name="amount" id="amount" tabindex="1" class="form-control" placeholder=" 0.00" value="">
                  </div>
              <div class="form-group col-xs-4 col-sm-4 paybtn">
                <input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-login" value="Log In">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>


    <?php

        include('footer.php');

    ?>

  </body>
</html>
