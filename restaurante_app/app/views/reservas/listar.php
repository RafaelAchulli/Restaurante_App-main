<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Reservas</title>
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
    <h1 style="text-align: center;">Reservas
    <?php
    session_start();
    if (isset($_SESSION['alerta'])) {
        echo "<div style='color: red; text-align: center;'>" . $_SESSION['alerta'] . "</div>";
        unset($_SESSION['alerta']); 
    }
    ?>   
   <form method="POST" action="../public/index.php?controller=ReservaController&action=reservar">
    <input type="date" name="fecha" placeholder="Fecha" required>
    <input type="time" name="hora" placeholder="Hora" required>
    <select name="id_mesa" id="mesa" required>
        <option value="">-- Selecciona una mesa --</option>
        <?php foreach ($mesas as $mesa): ?>
            <option value="<?= $mesa['id_mesa'] ?>">Mesa <?= $mesa['numero'] ?> (Capacidad: <?= $mesa['capacidad'] ?>)</option>
        <?php endforeach; ?>
    </select>
    <button type="submit">Reservar</button>
</form>
</h1>
    <table>
        <thead>
            <tr>
                <th>ID RESERVA</th>
                <th>ID USUARIO</th>
                <th>N° MESA</th>
                <th>Fecha</th>
                <th>Hora</th>
            </tr>

        </thead>

        <tbody>
            <?php foreach ($reservas as $reserva): ?>
                <tr>
                    <td> <?= $reserva['id_reserva'] ?></td>
                    <td> <?= $reserva['id_usuario'] ?></td>
                    <td> <?= $reserva['numero_mesa'] ?></td>
                    <td> <?= $reserva['fecha'] ?></td>
                    <td> <?= $reserva['hora'] ?></td>
                </tr>
                <?php endforeach; ?>
        </tbody>
    </table>
</body>
<html>