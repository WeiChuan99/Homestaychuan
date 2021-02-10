<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <ul class="navbar-nav mx-auto p-1 pr-5">
        <li><a class="nav-link " href="/">Home</a></li>
        <li><a class="nav-link" href="#contact">Contact</a></li>
        <div class="mx-5">
        <li><a class="navbar-brand mx-auto text-center" href="#"> Unexpected Journey </a></li>
        </div>
        <!-- if logged and its an admin -->
        <?php if(isset($_SESSION["user_details"]) && $_SESSION["user_details"]["isAdmin"]): ?>
          <li><a class="nav-link" href="/views/transactions.php">Transactions</a></li>
          <li><a class="nav-link" href="/controllers/auth/logout.php">Logout</a></li>
        <!-- if logged in and its a customer -->
        <?php elseif(isset($_SESSION["user_details"]) && !$_SESSION["user_details"]["isAdmin"]): ?>
          <li><a class="nav-link" href="/views/cart.php">
            Check 
            <span class="badge bg-primary" id="cart_count">
              <?php if(isset($_SESSION['cart']) && count($_SESSION['cart'])): ?>
              <?php echo array_sum($_SESSION["cart"]) ?>
              <?php else: ?>
                0
              <?php endif; ?>
            </span>
          </a></li>
          <li><a class="nav-link" href="/views/my_transactions.php">My Transactions</a></li>
          <li><a class="nav-link" href="/controllers/auth/logout.php">Logout</a></li>

        <!-- else if you are logged out -->
        <?php else: ?>
          <li><a class="nav-link" href="/views/forms/register.php">Register</a></li>
          <li><a class="nav-link" href="/views/forms/login.php">Login</a></li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>