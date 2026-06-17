<?php
$casa = array("cocina", "salón", "habitación", "baños", "trastero");
?>

<table border="1" cellpadding="5" cellspacing="0">
    <tbody>
        <tr>
        <?php foreach ($casa as $estancia): ?> 
                <td><?php echo $estancia; ?></td> 
        <?php endforeach; ?>
        </tr>
    </tbody>
</table>

<table border="1" cellpadding="5" cellspacing="0">
    <tbody>
        <tr> 
            <?php for ($i = 4; $i >= 0; $i--): ?> 
                <td><?php echo ($casa[$i]); ?></td> 
            <?php endfor; ?>
        </tr>
    </tbody>
</table>


<table border="1" cellpadding="5" cellspacing="0">
    <tbody>
        <?php for ($fila = 0; $fila <= 3; $fila++): ?>
            <tr>
                <?php for ($columna = 1; $columna <= 3; $columna++): ?>
                    <td><?php echo $casa[$fila]; ?></td>
                <?php endfor; ?>
            </tr>
        <?php endfor; ?>
    </tbody>
</table>


<table border="1" cellpadding="5" cellspacing="0">
    <tbody>
        <?php for ($fila = 1; $fila <= 3; $fila++): ?> //para abajo
            <tr>
                <?php for ($i = 1; $i <= 3; $i++): ?> //der e izq
                    <td><?php echo $i; ?></td>
                <?php endfor; ?>
            </tr>
        <?php endfor; ?>
    </tbody>
</table>


<table border="1" cellpadding="5" cellspacing="0">
    <tbody>
        <?php for ($fila = 1; $fila <= 3; $fila++): ?>
            <tr>
                <?php for ($i = 1; $i <= 3; $i++): ?>
                    <td><?php echo $fila; ?></td>
                <?php endfor; ?>
            </tr>
        <?php endfor; ?>
    </tbody>
</table>