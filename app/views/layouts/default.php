<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DEFAULT</title>
    <link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/main.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>



<nav role="navigation" class="navbar navbar-default">

    <!-- Brand and toggle get grouped for better mobile display -->

    <div class="navbar-header">

        <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">

            <span class="sr-only">Toggle navigation</span>

            <span class="icon-bar"></span>

            <span class="icon-bar"></span>

            <span class="icon-bar"></span>

        </button>

        <a href="/" class="navbar-brand">Tasker</a>

    </div>

    <!-- Collection of nav links and other content for toggling -->

    <div id="navbarCollapse" class="collapse navbar-collapse">

        <ul class="nav navbar-nav">

            <li class=""><a href="/">Home</a></li>

            <li><a href="/create/">Create task</a></li>

            <li><a href="/admin/">Admin Panel</a></li>

        </ul>

        <ul class="nav navbar-nav navbar-right">

            <?php if(!$user): ?>
            <li><a href="/admin/login">Login</a></li>
            <?php endif; ?>

            <?php if($user): ?>
                <li><a href="/admin/logout">Logout</a></li>
            <?php endif; ?>

        </ul>

    </div>

</nav>

<?=$content?>
<script src="/bootstrap/js/bootstrap.min.js"></script>


</body>
</html>