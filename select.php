<?php
include_once 'connection.php';
include_once 'functions.php';

$q = "SELECT * FROM users"; //WHERE id=2
$result = mysqli_query($conn, $q); //$result ir objekts, kurš satur visu informāciju par tabulu users

include_once 'header.php';
?>

    <section class="index-intro">
            <?php if($result ->num_rows > 0): ?>
                <table class="user-table">
                    <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>UID</th>
                    <th>Labot</th>
                    <th>Dzēst</th>
                    </tr>
                    <?php while($user = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?= $user['id'] ?></td>
                            <td><?= $user['name'] ?></td>
                            <td><?= $user['email'] ?></td>
                            <td><?= $user['uid'] ?></td>
                            <td><a href="update.php?id=<?= $user['id'] ?>">Labot</a> </td>
                            <td><a href="delete.php?id=<?= $user['id'] ?>">delete</a> </td>
                        </tr>
                    <?php endwhile; ?>
                </table>
            <?php else: ?>
                <h1> nav neviena lietotāja</h1>
            <?php endif; ?>

</section>

<?php include_once 'footer.php'; ?>

<?php while($row = mysqli_fetch_assoc($r)) ?>