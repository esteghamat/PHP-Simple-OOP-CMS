<?php

$current_users = $data['total_users'];

// echo "<pre>";
// var_dump($current_users);
// echo "</pre>";  
?>

<div class="container">
    <div class="row" style="margin-top : 10px; ">
    <div class="col-2"></div>
    <div class="col-8">
        <h4 class="card-title">Login Form</h4>
        <form action="#" name="SendMessageForm" method="POST">
        <div style="padding:15px">
            <div class="form-group">
            <label for="SenderName">ad soyad</label>
            <input type="text" class="form-control" name="SenderName" id="SenderName" placeholder="ad soyad*">
            </div>
            <div class="form-group">
            <label for="SenderName">telefon</label>
            <input type="text" class="form-control" name="SenderName" id="SenderName" placeholder="telefon*">
            </div>
            <div class="form-group">
            <label for="SenderName">E-mail</label>
            <input type="text" class="form-control" name="SenderName" id="SenderName" placeholder="E-mail*">
            </div>
            <button type="submit" class="btn btn-primary"   style="float: right;">GÖNDER</button>
        </div>
        </form>                   
    <div class="col-2"></div>
</div>


