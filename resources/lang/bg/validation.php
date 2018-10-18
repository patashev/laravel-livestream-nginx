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

    'accepted'             => ':attribute трябва да бъде приет.',
    'active_url'           => ':attribute не е валиден URL.',
    'after'                => ':attribute трябва да е дата след :date.',
    'after_or_equal'       => ':attribute трябва да е дата след или равна на :date.',
    'alpha'                => ':attribute трябва да садържа само букви.',
    'alpha_dash'           => ':attribute може да садържа само букви, цифри и тирета.',
    'alpha_num'            => ':attribute може да садържа само букви и цифри.',
    'array'                => ':attribute трябва да е низ.',
    'before'               => ':attribute трябва да е дата преди :date.',
    'before_or_equal'      => ':attribute трябва да е дата преди или равна на :date.',
    'between'              => [
        'numeric' => ':attribute трябва да е между :min и :max.',
        'file'    => ':attribute трябва да е между :min и :max килобайта.',
        'string'  => ':attribute трябва да е между :min и :max символа.',
        'array'   => ':attribute трябва да е между :min и :max предмета.',
    ],
    'boolean'              => ':attribute полето трябва да е true или false.',
    'confirmed'            => ':attribute потвърждение не съвпада.',
    'date'                 => ':attribute не е валидна дата.',
    'date_format'          => ':attribute не съвпада даденият формат :format.',
    'different'            => ':attribute и :other трябва да се раазличават.',
    'digits'               => ':attribute трябва да е :digits числено.',
    'digits_between'       => ':attribute трябва да е между :min и :max числа.',
    'dimensions'           => ':attribute има невалидни пропорции.',
    'distinct'             => ':attribute има повторна стойност.',
    'email'                => ':attribute трябва да е валиден адрес.',
    'exists'               => ':attribute е невалиден.',
    'file'                 => ':attribute трябва да е файл.',
    'filled'               => ':attribute поле трябва да има стойност.',
    'image'                => ':attribute трябва да е изображение.',
    'in'                   => ':attribute е невалиден.',
    'in_array'             => ':attribute поле не съществува в :other.',
    'integer'              => ':attribute трябва да е число.',
    'ip'                   => ':attribute трябва да е валиден IP адрес.',
    'ipv4'                 => ':attribute трябва да е валиден IPv4 адрес.',
    'ipv6'                 => ':attribute трябва да е валиден IPv6 адрес.',
    'json'                 => ':attribute трябва да е валиден JSON текст.',
    'max'                  => [
        'numeric' => ':attribute не може да е по голямо от :max.',
        'file'    => ':attribute не може да е по голямо от :max килобайта.',
        'string'  => ':attribute не може да е по голямо от :max символа.',
        'array'   => ':attribute не може да повече от :max предмета.',
    ],
    'mimes'                => ':attribute файл от тип: :values.',
    'mimetypes'            => ':attribute файл от тип: :values.',
    'min'                  => [
        'numeric' => ':attribute трябва да е поне :min.',
        'file'    => ':attribute трябва да е поне :min килобайта.',
        'string'  => ':attribute трябва да е поне :min символа.',
        'array'   => ':attribute трябва да има поне :min предмета.',
    ],
    'not_in'               => ':attribute е невалиден.',
    'numeric'              => ':attribute трябва да е чило.',
    'present'              => ':attribute поле трябва да налично.',
    'regex'                => ':attribute формат е невалиден.',
    'required'             => ':attribute поле е задължително.',
    'required_if'          => ':attribute поле е задължително когато :other е :value.',
    'required_unless'      => ':attribute поле е задължително овен ако :other е в :values.',
    'required_with'        => ':attribute поле е задължително когато :values е налична.',
    'required_with_all'    => ':attribute поле е задължително когато :values е налична.',
    'required_without'     => ':attribute поле е задължително когато :values не е налична.',
    'required_without_all' => ':attribute поле е задължително когато никоя от :values са налични.',
    'same'                 => ':attribute и :other трябва да съвпадат.',
    'size'                 => [
        'numeric' => ':attribute трябва да е :size.',
        'file'    => ':attribute трябва да е :size килобайта.',
        'string'  => ':attribute трябва да е :size символа.',
        'array'   => ':attribute трябва да садържа :size предмета.',
    ],
    'string'               => ':attribute трябва да е текстов наборт.',
    'timezone'             => ':attribute трябва да е валидна зона.',
    'unique'               => ':attribute вече се исползва.',
    'uploaded'             => ':attribute неуспя да се качи.',
    'url'                  => ':attribute формата не е валиден',

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
            'rule-name' => 'custom-message',
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
