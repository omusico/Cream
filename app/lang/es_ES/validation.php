<?php

return array(

	/*
	|--------------------------------------------------------------------------
	| Validation Language Lines
	|--------------------------------------------------------------------------
	|
	| The following language lines contain the default error messages used by
	| the validator class. Some of these rules have multiple versions such
	| such as the size rules. Feel free to tweak each of these messages.
	|
	*/

	"accepted"         => "El campo :attribute debe ser aceptado.",
	"active_url"       => "El campo :attribute no es una URL válida.",
	"after"            => "El campo :attribute debe ser una fecha posterior a :date.",
	"alpha"            => "El campo :attribute únicamente puede contener letras.",
	"alpha_dash"       => "El campo :attribute únicamente puede contener letras, números, y guiones.",
	"alpha_num"        => "El campo :attribute únicamente puede contener letras y números.",
	"array"            => "El campo :attribute debe contener un array.",
	"before"           => "El campo :attribute debe ser una fecha anterior a :date.",
	"between"          => array(
		"numeric" => "El campo :attribute debe estar comprendido entre :min y :max.",
		"file"    => "El campo :attribute debe estar comprendido entre :min y :max kilobytes.",
		"string"  => "El campo :attribute debe estar comprendido entre :min y :max caracteres.",
		"array"   => "El campo :attribute debe contener entre :min - :max elementos.",
	),
	"confirmed"        => "El campo :attribute no coincide con la confirmación.",
	"date"             => "El campo :attribute no es una fecha válida.",
	"date_format"      => "El campo :attribute no cumple el formato :format.",
	"different"        => "Los campos :attribute y :other deben ser diferentes.",
	"digits"           => "El campo :attribute debe contener :digits dígitos.",
	"digits_between"   => "El campo :attribute debe estar comprendido entre :min y :max dígitos.",
	"email"            => "El formato del campo :attribute es inválido.",
	"exists"           => "El campo seleccionado :attribute es inválido.",
	"image"            => "El campo :attribute debe ser una imagen.",
	"in"               => "El campo selected :attribute es inválido.",
	"integer"          => "El campo :attribute debe contener un entero.",
	"ip"               => "El campo :attribute debe contener una IP válida.",
	"max"              => array(
		"numeric" => "El campo :attribute no puede ser mayor que :max.",
		"file"    => "El campo :attribute no puede ser mayor que :max kilobytes.",
		"string"  => "El campo :attribute no puede ser mayor que :max caracteres.",
		"array"   => "El campo :attribute no puede contener más de :max elementos.",
	),
	"mimes"            => "El campo :attribute debe ser un archivo del tipo: :values.",
	"min"              => array(
		"numeric" => "El campo :attribute debe ser al menos :min.",
		"file"    => "El campo :attribute debe pesar al menos :min kilobytes.",
		"string"  => "El campo :attribute debe contener al menos :min caracteres.",
		"array"   => "El campo :attribute debe contener al menos :min elementos.",
	),
	"not_in"           => "El valor seleccionado en :attribute es inválido.",
	"numeric"          => "El campo :attribute debe ser un número.",
	"regex"            => "El formato del campo :attribute es inválido.",
	"required"         => "El campo :attribute es obligatorio.",
	"required_if"      => "El campo :attribute es obligatorio si :other es :value.",
	"required_with"    => "El campo :attribute es obligatorio cuando :values ha sido indicado.",
	"required_without" => "El campo :attribute es obligatorio cuando :values no ha sido indicado.",
	"same"             => "Los campos :attribute y :other deben coincidir.",
	"size"             => array(
		"numeric" => "El campo :attribute debe contener :size.",
		"file"    => "El campo :attribute debe contener :size kilobytes.",
		"string"  => "El campo :attribute debe contener :size caracteres.",
		"array"   => "El campo :attribute debe contener :size elementos.",
	),
	"unique"           => "El campo :attribute ya está en uso.",
	"url"              => "El formato del campo :attribute es inválido.",

	/*
	|--------------------------------------------------------------------------
	| Custom Validation Language Lines
	|--------------------------------------------------------------------------
	|
	| Here you may specify custom validation messages for attributes using the
	| convention "attribute.rule" to name the lines. This makes it quick to
	| specify a specific custom language line for a given attribute rule.
	|
	*/

	'custom' => array(),

	/*
	|--------------------------------------------------------------------------
	| Custom Validation Attributes
	|--------------------------------------------------------------------------
	|
	| The following language lines are used to swap attribute place-holders
	| with something more reader friendly such as E-Mail Address instead
	| of "email". This simply helps us make messages a little cleaner.
	|
	*/

	'attributes' => array(
		
	),

);
