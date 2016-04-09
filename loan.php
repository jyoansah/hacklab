<?php

    include('header.php');
 
?>

    <div class="dashboard container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
            <li><a href="dashboard.php">Overview <span class="sr-only">(current)</span></a></li>
            <li><a href="transactions.php">Make a Payment</a></li>
            <li class="active"><a href="loan.php">Apply for a Loan</a></li>
            <!-- <li><a href="#">Loan</a></li> -->
          </ul>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Transaction</h1>

          <div class="row placeholders">
            <div class="col-xs-6 col-sm-6 amount">
              <span class="text-muted">You currently owe:</span>
              <h1>GH₵ <?php echo number_format($user->getBalance(), 2, '.', '');?></h1>
            </div>
            <!-- <div class="col-xs-6 col-sm-6 amount">
              <span class="text-muted">Your slidepay balance:</span>
              <h1>GH₵ <?php echo $user->getBalance();?></h1>
            </div> -->
          </div>

          <br>
          <h2 class="sub-header">Apply for a Loan:</h2>
          <br>
          <div class="table-responsive">
            
            <form id="login-form" action="api/loans.php" method="post" role="form" style="display: block;">
                  <div class="form-group">
                    <input type="text" name="name" id="name" tabindex="1" class="form-control" placeholder="NAME" value="">
                  </div>

                  <div class="form-group">
                    <input type="text" name="name" id="name" tabindex="2" class="form-control" placeholder="NAME OF COMPANY">
                  </div>
<div class="form-group">
                    <input type="text" name="telephonenumber" id="telephonenumber" tabindex="3" class="form-control" placeholder="TELEPHONE NUMBER">
                  </div>
                   <div class="form-group">
                    <input type="text" name="address" id="homeaddress" tabindex="4" class="form-control" placeholder="HOME ADDRESS" value="">
                  </div>
                    <div class="form-group">
                    <input type="text" name="email" id="email" tabindex="5" class="form-control" placeholder="EMAIL" value="">
                  </div>
                  <div class="form-group">
                    <input type="text" names="collateral" id="collateral" tabindex="6" class="form-control" placeholder="COLLATERAL" value="">
                  </div>
                  <div class="form-group">
                    <input type="text" name="occupation" id="occupation" tabindex="7" class="form-control" placeholder="OCCUPATION" value="">
                  </div>
                  <div class="form-group">
                    <input type="text" name="amount" id="amount" tabindex="8" class="form-control" placeholder="AMOUNT" value="">
                  </div>
                  <div class="form-group">
                    <input type="text" name="mode of payment" id="mode of payment" tabindex="9" class="form-control" placeholder="MODE OF PAYMENT" value="">
                  </div>
                 
                  <div class="form-group">
                    <div class="row">
                      <div class="col-sm-6 col-sm-offset-3">
                        <input type="submit" name="loan-submit" id="loan-submit" tabindex="10" class="form-control btn btn-login" value="Submit Application">
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
