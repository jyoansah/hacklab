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
            
            <form id="login-form" action="api/loan.php" method="post" role="form" style="display: block;">
                  <div class="form-group">
                    <input type="text" name="NAME" id="NAME" tabindex="1" class="form-control" placeholder="NAME" value="">
                  </div>

                  <div class="form-group">
                    <input type="text" name="name" id="name" tabindex="2" class="form-control" placeholder="NAME OF COMPANY">
                  </div>
<div class="form-group">
                    <input type="text" name="telephonenumber" id="telephonenumber" tabindex="2" class="form-control" placeholder="TELEPHONE NUMBER">
                  </div>
                   <div class="form-group">
                    <input type="text" name="address" id="homeaddress" tabindex="1" class="form-control" placeholder="HOME ADDRESS" value="">
                  </div>
                    <div class="form-group">
                    <input type="text" name="email" id="email" tabindex="1" class="form-control" placeholder="EMAIL" value="">
                  </div>
                  <div class="form-group">
                    <input type="text" names="collateral" id="collateral" tabindex="1" class="form-control" placeholder="COLLATERAL" value="">
                  </div>
                  <div class="form-group">
                    <input type="text" name="occupation" id="occupation" tabindex="1" class="form-control" placeholder="OCCUPATION" value="">
                  </div>
                  <div class="form-group">
                    <input type="text" name="mode of payment" id="mode of payment" tabindex="1" class="form-control" placeholder="MODE OF PAYMENT" value="">
                  </div>

                 
                  <div class="form-group">
                    <div class="row">
                      <div class="col-sm-6 col-sm-offset-3">
                        <input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-login" value="Log In">
                      </div>
                    </div>
                  </div>

                 
                      </div>
                    </div>
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
