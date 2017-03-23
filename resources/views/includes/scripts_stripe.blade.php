<script type="text/javascript" src="https://js.stripe.com/v2/"></script>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="/public/ceek-v3/js/vendor/jquery-1.11.3.min.js"></script>
<script src="/public/ceek-v3/js/vendor/jquery.velocity.min.js"></script>

<!-- easing -->
<script src="/public/ceek-v3/js/jquery.easing.1.3.js"></script>
<!-- Bootstrap core JavaScript -->
<script src="/public/ceek-v3/js/bootstrap.min.js"></script>

<script src="/public/ceek-v3/js/bootstrapvalidator.min.js"></script>
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="/public/ceek-v3/js/ie10-viewport-bug-workaround.js"></script>
<script src="/public/ceek-v3/js/smoothscroll.js"></script>
<script src="/public/ceek-v3/js/wow.min.js"></script>

<!-- Custom JavaScript -->
<script src="/public/ceek-v3/js/app.js"></script>
<?php
if (App::environment('local')) 
    {
        ?>
            <script src="/public/ceek-v3/js/payment.js"></script>
        <?php
    }
    else 
    {
        ?>
            <script src="/public/ceek-v3/js/paymentLive.js"></script>
        <?php
    }
 ?>