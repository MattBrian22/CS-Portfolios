<?php

// logout
if (isset($_POST['but_logout'])) {
    session_destroy();
    header('Location: cine-page.php');
}

?>
<style>
.admin-section-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px;
    background-color: #f4cb01;
}

.admin-logo {
    font-size: 24px;
    height: 70px;
    width: 40px;
    margin-bottom: 120px;
    padding-bottom: 125px;
    background-color: #f4cb01 ;

}


.admin-login-info h2 {
    margin: 0;
    padding: 0 20px;
    font-size: 18px;
}

.admin-login-info form {
    margin-right: 10px;
}

</style>

<div class="admin-section-header">
    <div class="admin-logo">
        <img src = "Cine.png" alt="">
    </div>
    <div class="admin-login-info">
        <form method='post' action="cine-page.php">
            <input type="submit" value="Logout"  name="but_logout">
        </form>
    </div>
</div>
