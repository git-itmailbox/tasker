<div class="container">

    <h2>Login form</h2>
    <form action="" method="post">

        <div class="row">
            <div class="col-md-1 text">Login</div>
            <div class="col-md-2">
                <input type="text" name="login">
            </div>
            <div class="col-md-2"></div>
            <div class="col-md-2"></div>
        </div>
        <div class="row">
            <div class="col-md-1 text-right">Password</div>
            <div class="col-md-2">
                <input type="password" name="password">

            </div>
            <div class="col-md-2"></div>
            <div class="col-md-2"></div>
        </div>
   <div class="row">
       <div class="col-md-2 col-md-offset-2">
           <button type="submit" class="btn btn-default btn-lg">Login</button>
       </div>
        </div>


    </form>

    <div class="has-error">
        <?php if(isset($error)) echo $error;
//                var_dump($user);
        ?></div>
</div>