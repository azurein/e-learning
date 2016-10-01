<div class="col-lg-5 col-lg-offset-0 col-md-5 col-md-offset-1 col-sm-12 col-xs-12">
    <form class="custom-form" method="post">
        <h2 class="text-center form-heading login-heading">Log In Anggota</h2>
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-addon"><span><i class="fa fa-user"></i></span></div>
                <input type="text" name="user" class="form-control" placeholder="Username" autocomplete="new-username" autofocus required>
            </div>
        </div>
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-addon"><span><i class="fa fa-key"></i></span></div>
                <input type="password" name="pass" class="form-control" placeholder="Password" autocomplete="new-password" required>
            </div>
        </div>
        <!-- <div class="checkbox">
            <label>
                <input type="checkbox">Ingat Saya?</label>
        </div> -->
        <input type="submit" name="login" value="Masuk" class="btn btn-success btn-block submit-button" /><br>
        <?php
        if(@$_POST['login']) {
            $user = @mysqli_real_escape_string($db, $_POST['user']);
            $pass = @mysqli_real_escape_string($db, $_POST['pass']);
            $sql = mysqli_query($db, "SELECT * FROM tb_siswa WHERE username = '$user' AND password = md5('$pass')") or die ($db->error);
            $data = mysqli_fetch_array($sql);
            if(mysqli_num_rows($sql) > 0) {
                if($data['status'] == 'aktif') {
                    @$_SESSION['siswa'] = $data['id_siswa'];
                    echo '<script>window.location = "";</script>';
                } else {
                    echo '<div class="alert alert-warning">Login gagal, akun Anda sedang tidak aktif!</div>';
                }
            } else {
                echo '<div class="alert alert-danger">Login gagal, username / password salah, coba lagi!</div>';
            }
        } ?>
    </form>
</div>
