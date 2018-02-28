<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => ':attribute debe ser aceptado.',
    'active_url'           => ':attribute no es una URL valida.',
    'after'                => ':attribute debe ser una fecha despues de :date.',
    'after_or_equal'       => ':attribute debe ser una fecha despues o igual a :date..',
    'alpha'                => ':attribute solo debe contener letras.',
    'alpha_dash'           => ':attribute solo debe contener letras, numeros y guiones.',
    'alpha_num'            => ':attribute colo debe contener letras y nuemeros.',
    'array'                => ':attribute debe ser un array.',
    'before'               => ':attribute debe ser antes de :date.',
    'before_or_equal'      => ':attribute debe ser antes o igual a :date.',
    'between'              => [
        'numeric' => ':attribute debe estar entre :min y :max.',
        'file'    => ':attribute debe pesar entre :min y :max kilobytes.',
        'string'  => ':attribute debe tener entre :min y :max caracteres.',
        'array'   => ':attribute debe tener entre :min y :max elementos.',
    ],
    'boolean'              => ':attribute debe ser verdadero o falso.',
    'confirmed'            => 'debe confirmar :attribute.',
    'date'                 => ':attribute no es una fecha valida.',
    'date_format'          => ':attribute no coincide con el formato :format.',
    'different'            => ':attribute debe ser diferentes de :other.',
    'digits'               => ':attribute debe tener :digits digitos.',
    'digits_between'       => ':attribute debe tener entre :min y :max digitos.',
    'dimensions'           => ':attribute tiene dimensiones de imagen invalidas.',
    'distinct'             => ':attribute tiene un valor duplicado.',
    'email'                => ':attribute debe ser un email valido.',
    'exists'               => ':attribute es invalido.',
    'file'                 => ':attribute debe ser un archivo.',
    'filled'               => ':attribute debe tener un valor.',
    'image'                => ':attribute debe ser una imagen.',
    'in'                   => ':attribute seleccionado es invalido.',
    'in_array'             => 'el campo :attribute no existe en :other.',
    'integer'              => ':attribute debe ser un entero.',
    'ip'                   => ':attribute debe ser una direccion IP valida.',
    'ipv4'                 => ':attribute debe ser una direccion IPv4 valida.',
    'ipv6'                 => ':attribute debe ser una direccion IPv6 valida..',
    'json'                 => ':attribute debe ser una cadena JSON valida.',
    'max'                  => [
        'numeric' => ':attribute no debe ser mayor que :max.',
        'file'    => ':attribute no debe ser mas grande que :max kilobytes.',
        'string'  => ':attribute no debe contener mas de :max caracteres.',
        'array'   => ':attribute no debe tener mas de :max items.',
    ],
    'mimes'                => ':attribute debe ser del tipo: :values.',
    'mimetypes'            => ':attribute debe ser un archivo de tipo: :values.',
    'min'                  => [
        'numeric' => ':attribute debe ser almenos :min.',
        'file'    => ':attribute debe pesar almenos :min kilobytes.',
        'string'  => ':attribute debe tener almenos :min caracteres.',
        'array'   => ':attribute debe tener almenos :min items.',
    ],
    'not_in'               => 'El :attribute es invalido.',
    'numeric'              => ':attribute debe ser un numero.',
    'present'              => ':attribute debe existir.',
    'regex'                => ':attribute formato invalido.',
    'required'             => ':attribute archivo es requerido.',
    'required_if'          => ':attribute archivo es requerido cuando :other este :value.',
    'required_unless'      => ':attribute archivo es requerido amenos :other este en :values.',
    'required_with'        => ':attribute archivo es requerido cuando :values este presente.',
    'required_with_all'    => ':attribute archivo es requerido cuando :values este presente.',
    'required_without'     => ':attribute archivo es requerido cuando :values no este presente.',
    'required_without_all' => ':attribute archivo es requerido cuando ninguno de los :values este presente.',
    'same'                 => ':attribute y :other deben coincidir.',
    'size'                 => [
        'numeric' => ':attribute debe ser :size.',
        'file'    => ':attribute debe pesar :size kilobytes.',
        'string'  => ':attribute debe tener :size caracteres.',
        'array'   => ':attribute debe contener :size items.',
    ],
    'string'               => ':attribute debe ser una cadena de texto.',
    'timezone'             => ':attribute debe ser una zona horaria valida.',
    'unique'               => ':attribute ya fue tomado.',
    'uploaded'             => ':attribute falló la subida.',
    'url'                  => ':attribute formato de URL invalido.',

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

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'mensaje-personalizado',
        ],
    ],

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

    'attributes' => [],

];
