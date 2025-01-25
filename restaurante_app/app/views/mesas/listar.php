<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Mesas</title>
    <style>
    table {
        width: 80%;
        margin: 20px auto;
        border-collapse: collapse;
    }

    table, th, td {
        border: 1px solid black;
    }

    th, td {
        padding: 10px;
        text-align: center;
    }

    th {
        background-color: #f4f4f4;
    }
    </style>
</head>

<body>
    <h1 style="text-align: center;">Mesas
    <?php
    session_start();
    if (isset($_SESSION['alerta'])) {
        echo "<div style='color: red; text-align: center;'>" . $_SESSION['alerta'] . "</div>";
        unset($_SESSION['alerta']); 
    }
    ?>   
    <form method="POST" action="../public/index.php?controller=MesaController&action=crear">
        <input type="number" name="numero" placeholder="Numero" min="1" required>
        <input type="number" name="capacidad" placeholder="Capacidad" min="1" required>
        <button type="submit">Crear</button>
    </form>

    <form method="POST" action="../public/index.php?controller=MesaController&action=eliminar">
        <input type="number" name="numero" placeholder="Numero" min="1" required>
        <button type="submit">Eliminar</button>
    </form></h1>

    <table>
        <thead>
            <tr>
                <th>ID MESA</th>
                <th>Numero</th>
                <th>Capacidad</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($mesas as $mesa): ?>
                <tr>
                    <td> <?= $mesa['id_mesa'] ?></td>
                    <td> <?= $mesa['numero'] ?></td>
                    <td> <?= $mesa['capacidad'] ?></td>
                </tr>
                <?php endforeach; ?>
        </tbody>
    </table>
</body>
<html>