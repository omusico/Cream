<div class="form-group">
    <label for="color" class="control-label">Color</label>

    <div class="clearfix"></div>

    <?php $colors = array('blue' => 'Azul', 'green' => 'Verde', 'red' => 'Rojo', 'yellow' => 'Amarillo', 'grey' => 'Gris'); ?>

    @foreach ($colors as $key => $value)

        <div class="radio-inline">
            <label>
                @if (isset($statusId))
                    <?php 
                    if ($status->color == $key) $checked = array('checked' => 'checked');
                    else $checked = array();
                    ?>
                {{ Form::radio('color' . $statusId, $key, $checked) }} 
                @else
                {{ Form::radio('color', $key) }} 
                @endif
                <span class="label label-status label-{{ $key }}">{{ $value }}</span>
            </label>
        </div>

    @endforeach
    
    {{ $errors->first('color', '<p class="help-block">:message</p>') }}
</div>