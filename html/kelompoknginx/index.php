<?php
// DATA ANGGOTA
$anggota = [
    1 => [
        "nama" => "Ahnaf Naufadillah",
        "email" => "agnapluvluv@gmail.com",
        "foto" => "Ahnaf.jpeg",
        "kelas" => "XI TJKT-2",
        "alamat" => "Ciwaru",
        "hobi" => "Hiking",
        "tentang" => "Seseorang yang rajin dan suka mempelajari hal baru."
    ],
    2 => [
        "nama" => "Meicha Clara Nur Asyifa",
        "email" => "meicha668@gmail.com",
        "foto" => "Meicha.jpeg",
        "kelas" => "XI TJKT 2",
        "alamat" => "sanggar indah banjaran",
        "hobi" => "makan seblak",
        "tentang" => "seseorang yang rajin dan tidak sombong"
    ],
    3 => [
        "nama" => "Ahmad Zais Maulana Arifin",
        "email" => "ahmadzaiz275@gmail.com",
        "foto" => "Zais.jpeg",
        "kelas" => "XI TJKT 2",
        "alamat" => "karang anyar",
        "hobi" => "main game",
        "tentang" => "Anak baik, rajin, soleh."
    ],
    4 => [
        "nama" => "Sinta Bella",
        "email" => "sintabellaaw@gmail.com",
        "foto" => "Sinta.jpeg",
        "kelas" => "XI TJKT 2",
        "alamat" => "Soreang",
        "hobi" => "voly",
        "tentang" => "Sinta adalah pemain voly, anak baik."
    ]
];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Anggota Kelompok</title>

    <!-- CSS MENYATU -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #e6f0ff;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #003f8a;
            margin-bottom: 30px;
        }

        .container {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 20px;
        }

        .card {
            width: 250px;
            background: white;
            border-radius: 12px;
            padding: 15px;
            text-align: center;
            border: 2px solid #d0e0ff;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            transition: transform .3s, box-shadow .3s;
        }
        .card:hover {
            transform: translateY(-7px);
            box-shadow: 0 8px 18px rgba(0,0,0,0.25);
        }

        .card img {
            width: 130px;
            height: 130px;
            border-radius: 50%;
            border: 4px solid #2f6fed;
            object-fit: cover;
        }

        .btn {
            display: inline-block;
            margin-top: 10px;
            padding: 8px 14px;
            background: #2f6fed;
            color: white;
            border-radius: 6px;
            text-decoration: none;
        }
        .btn:hover { background: #1d3fa8; }

        .profile {
            width: 60%;
            margin: auto;
            background: white;
            padding: 25px;
            border-radius: 12px;
            text-align: center;
            border: 2px solid #c7d9ff;
            box-shadow: 0 4px 14px rgba(0,0,0,0.2);
        }
        .profile img {
            width: 180px;
            height: 180px;
            border-radius: 50%;
            border: 4px solid #2f6fed;
        }

        .back {
            display: inline-block;
            margin-top: 20px;
            padding: 8px 14px;
            background: #2f6fed;
            color: white;
            border-radius: 6px;
            text-decoration: none;
        }
        .back:hover { background: #1d3fa8; }
    </style>
</head>

<body>

<?php
// HALAMAN PROFIL
if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $a = $anggota[$id];
    ?>

    <div class="profile">
        <img src="<?= $a['foto'] ?>">
        <h2><?= $a['nama'] ?></h2>
        <p><strong>Email:</strong> <?= $a['email'] ?></p>
        <p><strong>Kelas:</strong> <?= $a['kelas'] ?></p>
        <p><strong>Alamat:</strong> <?= $a['alamat'] ?></p>
        <p><strong>Hobi:</strong> <?= $a['hobi'] ?></p>
        <p><?= $a['tentang'] ?></p>

        <a href="index.php" class="back">← Kembali</a>
    </div>

<?php
    exit;
}
?>

<h1>Daftar Anggota Kelompok</h1>

<div class="container">
    <?php foreach ($anggota as $id => $a): ?>
        <div class="card">
            <img src="<?= $a['foto'] ?>">
            <h2><?= $a['nama'] ?></h2>
            <p><strong>Email:</strong> <?= $a['email'] ?></p>
            <p><?= $a['tentang'] ?></p>

            <a class="btn" href="index.php?id=<?= $id ?>">Lihat Profil</a>
        </div>
    <?php endforeach; ?>
</div>

</body>
</html>
