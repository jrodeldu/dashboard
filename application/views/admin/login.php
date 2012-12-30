
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es-ES">
<head>
  <title>Gestor de Contenidos - Dashboard V5</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="description" content="Controlizer V3 - Gestor de Contenidos de IT7" />
  <meta name="robots" content="noindex" />
  <meta name="MSSmartTagsPreventParsing" content="true" />
  <meta http-equiv="pragma" content="no-cache" />
  <meta http-equiv="imagetoolbar" content="no" />

  <link rel="stylesheet" href="assets/css/admin/bootstrap/bootstrap.css">
  <!-- Bootstrap styles for responsive website layout, supporting different screen sizes -->
  <link rel="stylesheet" href="assets/css/admin/bootstrap/bootstrap-responsive.css">

  <link rel="shortcut icon" href="assets/images/admin/favicon.png" />
  <link rel="made" href="http://www.it7.info/" title="Instituto Canario de Telecomunicaciones (IT7)" />
  <link rel="copyright" href="http://www.it7.info/copyright.php" title="Copyright" />

  <style type="text/css">
      body#login{
        margin: 0;
        background: #CCC url(assets/images/admin/fon/fon.png) repeat top left;
        color: black;
        font-family: "Trebuchet MS", Helvetica, Arial, sans-serif;
      }

      form.login {
        /*width: 25em;*/
        margin-top: 1em;
        padding: 1em;
        background: white url(assets/images/admin/fon/cab.jpg) repeat-x left top;
        border-bottom: 1px solid #919C9B;
        border-right: 1px solid #919C9B;
      }

      form.login h1{
        margin: 0 0 0.7em 0;
        background: url(assets/images/admin/logo.gif) no-repeat left 50%;
        padding: 0 0 0 3em;
        color: white;
        font-size: 1.6em;
      }
  </style>
</head>

<body id="login">
<div class="container-fluid">
  <div class="row-fluid">
    <div class="span4 offset4">
      <form id="login" name="login" action="" method="post" class="login" enctype="multipart/form-data">
        <h1>Gestor de contenidos</h1>
          <fieldset>
          <legend>Acceso al gestor</legend>
          <p>Ambos campos son obligatorios.</p>
          <div class="control-group">
            <div class="controls">
              <label class="controls" for="nombre">Nombre de usuario: <?php echo form_error('email', '<div class="alert alert-error">', '</div>'); ?></label>
              <input type="text" id="email" name="email" title="Escriba su nombre de usuario" class="text" value="<?php echo set_value('email'); ?>" />
            </div>
          </div>
          <div class="control-group">
            <div class="controls">
              <label class="controls" for="contrasenia">Contraseña: <?php echo form_error('userpass', '<div class="alert alert-error">', '</div>'); ?></label>
              <input type="password" id="userpass" name="userpass" title="Escriba su contraseÇ&ntilde;a" class="text" />
            <!-- <dd><a href="#">¿Ha olvidado su contraseña?</a></dd> -->
              </div>
          </div>
          </fieldset>
          <fieldset class="botones">
            <input name="input" type="submit" class="btn" value="Entrar" title="Pulse para acceder al gestor" />
          </fieldset>
      </form>
    </div>
  </div>
</div>
</body>
</html>