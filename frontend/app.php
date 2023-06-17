<?php
require_once '../session.php';

if (!isset($_SESSION['username'])) {
    header('Location: ' . BASE_URL . '/frontend/login.php');
    exit;
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Dashboard</title>
    <!-- Inclua os arquivos CSS do Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- meta refresh -->
    <meta http-equiv="refresh" content="<?= (SESSION_TIME + 1) ?>" />
    <!-- <script src="<?= BASE_URL ?>/frontend/assets/ajax.js"></script> -->
    <script>
    async function carregaDados() {
        let box = document.getElementById('dados');
        await fetch(new Request('<?= BASE_URL ?>/backend/dados.php'))
            .then(
                function(response) {
                    response.text().then(
                        function(data) {
                            box.innerHTML = data;
                        }
                    );
                }
            )
            .catch(
                function(error) {
                    console.log(error);
                }
            )
    }
    </script>
</head>

<body>
    <div class="container">
        <h1>Bem-vindo, <?php echo $_SESSION['username']; ?>!</h1>
        <p><a href="<?= BASE_URL ?>/backend/logout.php">Log Out</a></p>
        <hr>
        <?php require_once BASE_PATH . '/frontend/clientes.php'; ?>
    </div>

    <!-- Inclua os arquivos JS do Bootstrap -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>