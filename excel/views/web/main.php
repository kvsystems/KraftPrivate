<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><? if($title) echo $title?></title>

    <link href="/excel/views/assets/bootstrap-3.3.7/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<nav class="navbar navbar-toggleable-md navbar-inverse bg-inverse fixed-top">

</nav>

<div class="container">

    <div class="starter-template">
        <h1><? if($title) echo $title?></h1>
        <p class="lead"><? if(isset($_SESSION['system_message'])) echo $_SESSION['system_message']?></p>
    </div>

    <? if($parsed) { ?>

    <table class="table">
        <thead>
        <tr>
            <? foreach($parsed['fields'] as $field) { ?>
                <th scope="col"><?=$field?></th>
            <? } ?>
        </tr>
        </thead>
        <tbody>
        <? foreach($parsed['values'] as $values) { ?>

            <tr>
                <? foreach($values as $value) { ?>
                    <td><?=$value?></td>
                <? } ?>
            </tr>

        <? } ?>

        </tbody>
    </table>

    <? } ?>

</div>

<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
<script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
<script src="/excel/views/assets/bootstrap-3.3.7/js/bootstrap.min.js"></script>

</body>
</html>
