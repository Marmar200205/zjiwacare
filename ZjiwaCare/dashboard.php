<?php
include 'database.php'; 
session_start();
$user_id = $_SESSION['user_id'];
if(isset($_POST['logout'])){
    session_unset();
    session_destroy();
    header('location: home.html');
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="dashboard.css">
</head>

<body>
    <div class="container mt-5">
        <div class="card p-4 shadow">
            <h1 class="text-center mb-4">Dashboard</h1>
            <h3 class="text-center">Selamat datang, <?= $_SESSION["username"] ?></h3>
            <form action="dashboard.php" method="POST" class="text-center mt-3">
                <button type="submit" name="logout" class="btn btn-primary">Log Out</button>
            </form>


        <?php
            $sql = "SELECT * FROM users WHERE id = '$user_id'";
            $result = $db->query($sql);

            if($result->num_rows>0) {
                $data = $result->fetch_assoc();
                // Perbarui session dengan data terbaru 
                $_SESSION["name"] = $data["name"];
                $_SESSION["username"] = $data["username"];
                $_SESSION["contact"] = $data["contact"];
                $_SESSION["data_kelahiran"] = $data["data_kelahiran"];
                $_SESSION["umur"] = $data["umur"];
                $_SESSION["jenis_kelamin"] = $data["jenis_kelamin"];
                $_SESSION["pendidikan_karir"] = $data["pendidikan_karir"];
                $_SESSION["alamat"] = $data["alamat"];
            } else {
                echo "<p class='text-danger'>No user found.</p>";
            }
        ?>

    <div class="row align-items-center mt-4">
        <div class="col-md-8">
            <table class="table table-borderless">
                    <tbody>
                            <tr>
                                <td><strong>Username</strong></td>
                                <td>:</td>
                                <td><?= $_SESSION['username'] ?></td>
                            </tr>
                            <tr>
                                <td><strong>Nama</strong></td>
                                <td>:</td>
                                <td><?= $_SESSION['name'] ?></td>
                            </tr>
                            <tr>
                                <td><strong>No. Telepon</strong></td>
                                <td>:</td>
                                <td><?= $_SESSION['contact'] ?></td>
                            </tr>
                            <tr>
                                <td><strong>Tempat, Tanggal Lahir</strong></td>
                                <td>:</td>
                                <td><?= $_SESSION["data_kelahiran"] ?></td>
                            </tr>
                            <tr>
                                <td><strong>Umur</strong></td>
                                <td>:</td>
                                <td><?= $_SESSION['umur'] ?></td>
                            </tr>
                            <tr>
                                <td><strong>Jenis Kelamin</strong></td>
                                <td>:</td>
                                <td><?= $_SESSION['jenis_kelamin'] ?></td>
                            </tr>
                            <tr>
                                <td><strong>Pendidikan/Karir</strong></td>
                                <td>:</td>
                                <td><?= $_SESSION['pendidikan_karir'] ?></td>
                            </tr>
                            <tr>
                                <td><strong>Alamat</strong></td>
                                <td>:</td>
                                <td><?= $_SESSION['alamat'] ?></td>
                            </tr>
                    </tbody>
            </table>
        </div>


        <div class="col-md-4 text-center">
            <?php
                    if($data['image'] == ''){
                        echo '<img src="1.png" class="img-thumbnail rounded-circle" alt="Foto Profil" width="150">';  
                    } else {
                        echo '<img src="' . $data['image'] . '" class="img-thumbnail rounded-circle" alt="Foto Profil" width="150">';
                    }
                    ?>

        <div class="mt-3">
            <a href="update_dashboard.php" class="btn btn-primary">Update Profile</a>
        </div>
    </div>
</div>
</div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
