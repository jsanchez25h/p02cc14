
<html>
<head>
  <title>
      
  </title>
  <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
  <!-- Incluir ficheros y scripts externos aquí (Mirar el ayudante HTML para más información -->

  
</head>
<body>

  <!-- Si quieres algún tipo de menú para mostrar en todas tus vistas, incluyelo aquí -->
  <div id="cabecera">
      <div id="menu">...</div>
  </div>
<form action="/gitHub/p02cc14/ComlecSuministros/saveForm" id="ComlecSuministroFormForm" enctype="multipart/form-data"  method="post" >
  <div style="display:none;"><input type="hidden" name="_method" value="POST"></div>

  <div class="input text"><label for="ComlecSuministroNumsuministro">Numsuministro</label><input name="data[ComlecSuministro][numsuministro]" maxlength="50" type="text" value="" id="ComlecSuministroNumsuministro"></div><input id="file" type="file" name="file"><div class="input textarea"><label for="ComlecSuministroDireccion"></label><textarea name="data[ComlecSuministro][direccion]" rows="3" cols="30" id="ComlecSuministroDireccion">ffff</textarea></div><div class="submit"><input type="submit" value="Save Post"></div></form>
<?php
 $this->Form->create('ComlecSuministro');
 $this->Form->input('numsuministro');

 '<input id="filexml" type="file" name="filexml" />';

 $this->Form->input('direccion', array('rows' => '3'));
 $this->Form->end('Save Post');

?>
  <!-- Aquí es donde quiero que se vean mis vistas -->
  <?php 
       



        ?>
  <!-- Añadir un pie de página a cada página mostrada -->
  <div id="pie">...</div>

</body>
</html>