@if (Input::get('redirect'))
{{ Form::hidden('redirect_url', Crypt::decrypt(Input::get('redirect'))) }}
@elseif (Input::old('redirect_url'))
{{ Form::hidden('redirect_url', Input::old('redirect_url')) }}
@endif