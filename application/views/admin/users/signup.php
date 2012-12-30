	<div class="span9">
    <div class="row-fluid">
        <h1 class="page-title">
            <i class="icon-th-list icon-white"></i>
            Formulario
        </h1>
    </div>
    <div class="row-fluid">
    <div class="widget">
        <div class="widget-header">
            <i class="icon-th-list"></i>
            <h3>Añada un usuario</h3>
        </div>
        <div class="widget-content nopadding">
                <?php echo form_open($this->uri->uri_string, array('id' => 'signup_form', 'class' => 'form-horizontal')); ?>
                    <?php if(validation_errors()){ ?>
                        <div class="alert alert-block alert-error">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <?php echo validation_errors(); ?>
                        </div>
                    <?php } ?>

                        <?php if ( !empty($message) ) { ?>
                        <div class="alert alert-block alert-success">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <?php echo $message; ?>
                        </div>
                        <?php } ?>

                        <?php if ( !empty($error) ){ ?>
                        <div class="alert alert-block alert-error">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <?php echo $error; ?>
                        </div>
                        <?php } ?>

                    <div class="control-group">
                        <label class="control-label" for="nombre">(*) Nombre:</label>
                        <div class="controls">
                        <input type="text" id="nombre" maxlength="50" name="nombre" value="<?php echo set_value('nombre'); ?>" placeholder="nombre" title="Escriba su nombre" class="text validate[required]" />
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="apellidos">(*) Apellidos:</label>
                        <div class="controls">
                        <input type="text" id="apellidos" maxlength="100" name="apellidos" value="<?php echo set_value('apellidos'); ?>" placeholder="apellido apellido" title="Escriba sus apellidos" class="text validate[required]"/>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="username">(*) Username:</label>
                        <div class="controls">
                        <input type="text" id="username" name="username" maxlength="30" value="<?php echo set_value('username'); ?>" placeholder="miusuario" title="Introduzca su nombre de usuario" class="validate[required]" />
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="userpass">(*) Contraseña:</label>
                        <div class="controls">
                        <input type="password" id="userpass" maxlength="30" name="userpass" placeholder="contraseña" title="Introduzca su contraseña" class="validate[required]" />
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="passconf">(*) Confirmar contraseña:</label>
                        <div class="controls">
                        <input type="password" id="passconf" maxlength="30" name="passconf" placeholder="contraseña" title="Confirme su contraseña" class="validate[required]" />
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="email">(*) Email:</label>
                        <div class="controls">
                        <input type="text" id="email" name="email" maxlength="100" value="<?php echo set_value('email'); ?>" placeholder="mimail@mail.com" title="Introduzca su correo electrónico" class="text validate[custom[email]]" />
                        </div>
                    </div>
                    <div class="control-group">
                      <label class="control-label" for="captcha">(*) Código Captcha:</label>
                      <div class="controls">
                      <?php echo $recaptcha; ?>
                      </div>
                    </div>

                    <div class="form-actions">
                        <input type="submit" value="Guardar" class="btn btn-primary" value="Guardar" title="Pulse para registrar usuario" />
                        <input type="button" class="btn" value="Cancelar" title="Pulse para cancelar esta tarea y volver atrás" onclick="location.href='http://www.it7.info/admin/users'" />
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>