<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crud-js-Empleados</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script type="text/javascript" src="js/jquery.js"></script>
</head>
 <body>
 <nav class="navbar navbar-expand-lg navbar-blue bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Empleado</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDarkDropdown" aria-controls="navbarNavDarkDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
      <ul class="navbar-nav">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Menu
          </a>
          <ul class="dropdown-menu dropdown-menu-blue" aria-labelledby="navbarDarkDropdownMenuLink">
            <li><a class="dropdown-item" href="#">Action</a></li>
            
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>
    <br>
    <table style="width:50%" class="table table-blue table-bordered">
        <thead>
            <th>No.</th>
            <th>Nombre</th>
            <th>Correo</th>
            <th>Estado</th>
            <th></th>
        </thead>
        <tbody id="tablaEmpleado">

        </tbody>
    </table >
    <!-- CREAR NUEVO EMPLEADO  -->
    <h2> Nuevo empleado</h2>
     <table>
     <tr>
             <!-- <td>ID</td> -->
             <td><input type="hidden" name="id"  disabled></td>

         </tr>
         <tr>
             <td>Nombre</td>
             <td><input type="text" name="nombre"  ></td>

         </tr>
         <tr>
             <td>CORREO</td>
             <td><input type="text" name="correo"  ></td>

         </tr>
         <tr>
             <td>ESTADO</td>
             <td><input type="text" name="estado" ></td>

         </tr>
         <tr>
         <td ><button class="btn btn-info" id="guardarUpdate" onclick="updatedata()">ACTUALIZAR</button></td>
             <td><button class="btn btn-primary" id="Update" onclick="guardar()">ENVIAR</button></td>
         </tr>
     </table>
     <!-- el id de crearempleado -->
      <p id="crearEmpleado"></p>
    <script type="text/javascript" >
        onload();
        //funcion para actualizar
           function updatedata() {
            var id =$("[name='id']").val();
            var nombre =$("[name='nombre']").val();
            var correo =$("[name='correo']").val();
            var estado =$("[name='estado']").val();

              $.ajax({
                  type : "POST",
                  data :"id="+id+"&nombre="+nombre+"&correo="+correo+"&estado="+estado,
                  url : 'updatedata.php',
                  success : function(result){
                      //console.log(result);

                      var objResult=JSON.parse(result);
                      $("#crearEmpleado").html(objResult.crearEmpleado);
                       onload();
                    }
              })
          }
           
          // funcion para crearEmpleado
          function guardar(){
              var nombre =$("[name='nombre']").val();
              var correo =$("[name='correo']").val();
              var estado =$("[name='estado']").val();
               
              $.ajax({
                  type : "POST",
                  data : "nombre="+nombre+"&correo="+correo+"&estado="+estado,
                  url : 'crearEmpleado.php',
                  success : function(result){
                      //console.log(result);

                      var objResult=JSON.parse(result);
                      $("#crearEmpleado").html(objResult.crearEmpleado);
                       onload();
                    }
              })
          }
           //FUNCION  update
           function update(idx) {
               
               var id=idx;
               $.ajax({
                  type :"POST",
                  data :"id="+id,
                  url :"update.php",
                  success : function(result) {
                     //console.log(result); 
                     var objResult = JSON.parse(result);
                     $("[name='id']").val(objResult.id);
                     $("[name='nombre']").val(objResult.nombre);
                     $("[name='correo']").val(objResult.correo);
                     $("[name='estado']").val(objResult.estado);
                     $("#Update").hide();
                     $("#guardarUpdate").show();
                  }
               })   
           }

           //funcion para borrar datos
           function borrarDatos(id){
               //console.log(id);
               var borra = confirm("Usted esta seguro de borrar estos datos");
               if (borra) {
                $.ajax({
                   type : "POST",
                   data : "id="+id,
                   url : 'borrar.php',
                   success : function($result) {
                       onload();
                   }
               })
           }
        }
        function onload(){
            var dataHandler=$("#tablaEmpleado");
             dataHandler.html("");
         //funcion para read
        $.ajax({
            type : "GET",
            data : " ",
            url : 'empleadodata.php',
            success : function(result){
                //1- para mostrar en la consola del navigador
                // console.log(result);
               //PARA MOSTRAR EN LA WEB
                var objResult=JSON.parse(result);
                $.each(objResult, function(key,value){
                    //PARA CAMBIAR LOS NUMEROS DE ID 
                    //var cambioId=1;
                    //OBTENCION LOS DATOS EN LA TABLA
                    var empl=$("<tr>");
                    empl.html("<td>"+value.id+"</td><td>"+value.nombre+"</td><td>"
                    +value.correo+"</td><td>"+value.estado+"</td><td><button onclick='update("
                    +value.id+")'>Select</button><button onclick='borrarDatos("+value.id+")'>Delete</button></td>")
                    //var dataHandler=$("#tablaEmpleado");
                    dataHandler.append(empl);
                    //EL INCREMENTO DE ID
                    //cambioId++;
                    $("#guardarUpdate").hide();
                    $("#Update").show();

                })
            }
        })
    }
    </script>
</body>
</html>