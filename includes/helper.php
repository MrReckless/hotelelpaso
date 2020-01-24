<?php


function getHabDisponible($idtipoHabitacion){
    $con =mysqli_connect('localhost','root','','hoteldb');
    $query = "select * from disponibilidad where idTipoHabitacion=$idtipoHabitacion";
    $resultado = mysqli_query($con,$query);

    while($row=mysqli_fetch_array($resultado)){
        $disponibles = $row['disponibles'];
    }

    return $disponibles;

} 


function getReservas($id){
    $con =mysqli_connect('localhost','root','','hoteldb');
    $query= "select idReservaciones, tipoHabitacion, noches, costo from reservaciones
    join tipohabitacion
    on tipohabitacion.idTipoHabitacion = reservaciones.idTipoHabitacion
    where idUsuario = $id"; 
    $resultado = mysqli_query($con,$query);
    $arreglo = array();
    $i = 1;
    while($row = mysqli_fetch_array($resultado)){
        echo '<form method="POST" action="includes/deleteReserva.php">';
        echo "<tr>";
        echo "<td>";
        echo '<input style="border:0px"; type="text" readonly name="txtID" value=';
        echo $row['idReservaciones'];
        echo ' "/>';
        $arreglo[$i] = $row['idReservaciones'];
        echo "</input>";
        echo "</td>";
        echo "<td>";
        echo $row['tipoHabitacion'];
        echo "</td>";
        echo "<td>";
        echo $row['noches'];
        echo "</td>";
        echo "<td>";
        echo $row['costo'];
        echo "</td>";
        echo "<td>";
        echo "<button class='btn btn-danger type='submit'>";
        echo 'Cancelar reserva</button>';
        echo "<a class='btn btn-success' href='./modificaReserva.php'>";
        echo 'Modificar Reserva</a>';
        echo "</td>";
        echo "</tr>";
        echo "</form>";

        $i++;
    }
}

function modifica($id){
    $con =mysqli_connect('localhost','root','','hoteldb');
    $query= "select idReservaciones, tipoHabitacion, noches, costo from reservaciones
    join tipohabitacion
    on tipohabitacion.idTipoHabitacion = reservaciones.idTipoHabitacion
    where idUsuario = $id
    order by idReservaciones"; 
    $resultado = mysqli_query($con,$query);
    $arreglo = array();
    $i = 1;
    while($row = mysqli_fetch_array($resultado)){
        $tipohab=$row['tipoHabitacion'];
        echo '<form method="POST" action="includes/modificaReserva.php">';
        echo "<tr>";
        echo "<td>";
        echo '<input style="border:0px"; type="text"  name="txtID" readonly  value=';
        echo $row['idReservaciones'];
        echo ' "/>';
        $arreglo[$i] = $row['idReservaciones'];
        echo "</input>";
        echo "</td>";
        echo "<td>";
        echo "<select name='txtTipoHabitacion'>";
        echo "<option>";
        echo $row['tipoHabitacion'];
        echo "</option>";
        echo "<option>";

        if($tipohab == "Simple"){
            $tipohab = "Suite";
            echo $tipohab;
        }else if ($tipohab=="Suite"){
            $tipohab="Simple";
            echo $tipohab;
        }

        echo "</option>";
        echo "</td>";
        echo "<td>";
        echo '<input type="number" name="txtNoches" value="';
        echo $row['noches'];
        echo '"/>';
        echo "</td>";
        echo "<td>";
        echo $row['costo'];
        echo "</td>";
        echo "<td>";
        echo "<button class='btn btn-danger type='submit'>";
        echo 'Modificar</button>';
      
        echo "</td>";
        echo "</tr>";
        echo "</form>";

        $i++;
    }
}
function getPrecio($idtipoHabitacion){
    $con =mysqli_connect('localhost','root','','hoteldb');
    $query = "select * from tipohabitacion where idTipoHabitacion=$idtipoHabitacion";
    $resultado = mysqli_query($con,$query);
    while($row=mysqli_fetch_array($resultado)){
        $precio = $row['precio'];
    }
    return $precio;
}


?>