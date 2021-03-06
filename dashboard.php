<?php

    include('header.php');

?>

    <div class="dashboard container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
            <li class="active"><a href="#">Overview <span class="sr-only">(current)</span></a></li>
            <li><a href="transaction.php">Make a Payment</a></li>
            <li><a href="loan.php">Apply for a Loan</a></li>
            <!-- <li><a href="#">Loan</a></li> -->
          </ul>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Dashboard</h1>

          <div class="row placeholders">
            <div class="col-xs-6 col-sm-6 amount">
              <span class="text-muted">You currently owe:</span>
              <h1>GH₵ <?php echo number_format($user->getBalance(), 2, '.', '');?></h1>
            </div>
            <div class="col-xs-3 col-sm-3 dashbtn">
              <a href="transaction.php" role="button" class="btn btn-primary">Pay Money</a>
            </div>
            <div class="col-xs-3 col-sm-3 dashbtn">
              <a href="loan.php" role="button" class="btn btn-primary">Apply for Loan</a>
            </div>
          </div>

          <h2 class="sub-header">Recent Transactions</h2>
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Id</th>
                  <th>Date</th>
                  <th>Amount</th>
                </tr>
              </thead>
              <tbody>
              <?php

                $trans = getUserTransactions($conn, $user->getId());
                foreach($trans as $t){

              ?>
                <tr>
                  <td><?php echo $t->getId();?></td>
                  <td><?php echo $t->getTDate();?></td>
                  <td><?php echo $t->getAmount();?></td>
                </tr>
              <?php } ?>
              </tbody>
            </table>
          </div>

          <h2 class="sub-header">Recent Loans</h2>
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Id</th>
                  <th>Date Submitted</th>
                  <th>Amount</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
              <?php

                $loans = getUserLoans($conn, $user->getId());
                foreach($loans as $l){

              ?>
                <tr>
                  <td><?php echo $l->getId();?></td>
                  <td><?php echo $l->getSDate();?></td>
                  <td><?php echo $l->getAmount();?></td>
                  <td><?php echo $l->getStatus();?></td>

                </tr>
              <?php } ?>
              </tbody>
            </table>
          </div>

        </div>
      </div>
    </div>


    <?php

        include('footer.php');

    ?>

  </body>
</html>
