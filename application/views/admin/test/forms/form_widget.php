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
                <h3>Validación de formularios (JavaScript)</h3>
            </div>
            <div class="widget-content nopadding">
                <form action="" method="post" class="AdvancedForm form-horizontal">
                <div class="control-group">
                    <label class="control-label" for="campo">Campo obligatorio letras</label>
                    <div class="controls">
                        <input type="text" name="campo" id="campo" />
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label"  for="email">Inserte un correo</label>
                    <div class="controls">
                        <input type="text" name="email" id="email" />
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label"  for="dni">DNI</label>
                    <div class="controls">
                        <input type="text" name="dni" id="dni" />
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label"  for="numero">Número</label>
                    <div class="controls">
                        <input type="text" name="numero" id="numero" />
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label"  for="fecha">Fecha (DD/MM/AAAA)</label>
                    <div class="controls">
                        <input type="text" name="fecha" id="fecha" />
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label"  for="entero">Número entero</label>
                    <div class="controls">
                        <input type="text" name="entero" id="entero" />
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label"  for="password">Password</label>
                    <div class="controls">
                        <input type="text" name="password" id="password" />
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label"  for="confirmPassword">Confirmar Password</label>
                    <div class="controls">
                        <input type="password" name="confirmPassword" id="confirmPassword" />
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label"  for="confirmPassword">Número entre 100 y 250</label>
                    <div class="controls">
                        <input type="password" name="calculo" id="calculo" />
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label"  for="selection">Selecciona un Campo</label>
                    <div class="controls">
                        <select name="selection" id="selection">
                            <option value="">Selecciona un campo</option>
                            <option value="Option 1">Option 1</option>
                            <option value="Option 2">Option 2</option>
                            <option value="Option 3">Option 3</option>
                            <option value="Option 4">Option 4</option>
                        </select>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label"  for="multiSelection">Selecciona varios Campos</label>
                    <div class="controls">
                        <select name="multiSelection" id="multiSelection" multiple="multiple">
                            <option value="Option 1">Option 1</option>
                            <option value="Option 2">Option 2</option>
                            <option value="Option 3">Option 3</option>
                            <option value="Option 4">Option 4</option>
                        </select>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label"  for="ValidRadio">Selecciona Radio Button</label>
                    <!-- <span id="ValidRadio" class="InputGroup help-inline"></span> -->
                    <div class="controls">
                        <label for="ValidRadio_1" class="radio">Radio Button 1
                            <input type="radio" name="ValidRadio" id="ValidRadio_1" value="1" />
                        </label>
                        <label for="ValidRadio_2" class="radio">Radio Button 2
                            <input type="radio" name="ValidRadio" id="ValidRadio_2" value="2" />
                        </label>
                        <label for="ValidRadio_3" class="radio">Radio Button 3
                            <input type="radio" name="ValidRadio" id="ValidRadio_3" value="3" />
                        </label>
                        <label for="ValidRadio_4" class="radio">Radio Button 4
                            <input type="radio" name="ValidRadio" id="ValidRadio_4" value="4" />
                        </label>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label"  for="ValidCheckbox">Selecciona a Checkbox Button</label>
                    <!-- <span id="ValidCheckbox" class="InputGroup"></span> -->
                    <div class="controls">
                        <label for="ValidCheckbox_1" class="checkbox">Checkbox 1
                            <input type="checkbox" name="ValidCheckbox" id="ValidCheckbox_1" value="1" />
                        </label>
                        <label for="ValidCheckbox_2" class="checkbox">Checkbox 2
                            <input type="checkbox" name="ValidCheckbox" id="ValidCheckbox_2" value="2" />
                        </label>
                        <label for="ValidCheckbox_3" class="checkbox">Checkbox 3
                            <input type="checkbox" name="ValidCheckbox" id="ValidCheckbox_3" value="3" />
                        </label>
                        <label for="ValidCheckbox_4" class="checkbox">Checkbox 4
                            <input type="checkbox" name="ValidCheckbox" id="ValidCheckbox_4" value="4" />
                        </label>
                    </div>
                </div>
                <div class="form-actions">
                    <input type="submit" value="Enviar" class="btn btn-primary"/>
                    <input type="submit" value="Cancelar" class="btn"/>
                </div>

                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/admin/test_form_widget.js"></script>