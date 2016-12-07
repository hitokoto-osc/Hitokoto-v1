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

    'accepted'             => ':attribute 必须被允许。',
    'active_url'           => 'Url无效。(:attribute)',
    'after'                => ':attribute 的日期必须在 :date 之后。',
    'alpha'                => ':attribute 只能包含字母。',
    'alpha_dash'           => ':attribute 只能包含字母、数字和下划线。',
    'alpha_num'            => ':attribute 只能包含字母和数字。',
    'array'                => ':attribute 必须是一个数组。',
    'before'               => ':attribute 的日期必须在 :date 之前。',
    'between'              => [
        'numeric' => '输入的 :attribute 必须是 :min - :max 位。',
        'file'    => '上传的文件(:attribute)大小必须在 :min KB- :max KB之间。',
        'string'  => '输入的 :attribute 必须是 :min - :max 位。',
        'array'   => ' :attribute 必须有 :min - :max 的项目。',
    ],
    'boolean'              => '您必须对 :attribute 做出选择(正确/错误)。',
    'confirmed'            => '您必须确认 :attribute 之后才能继续操作。',
    'date'                 => ':attribute 是空的。',
    'date_format'          => ':attribute 不符合格式(:format)。',
    'different'            => ':attribute 和 :other 不能一样。',
    'digits'               => ':attribute 必须是 :digits 数字。',
    'digits_between'       => ':attribute 必须在 :min 到 :max 位之间。',
    'distinct'             => ':attribute 必须输入一个相同的键值。',
    'email'                => '请输入一个正确的E-mail地址',
    'exists'               => ':attribute 是存在的。',
    'filled'               => ':attribute 是一个无效的键值。',
    'image'                => ':attribute 必须是一个图片。',
    'in'                   => ':attribute 是无效的。',
    'in_array'             => ':attribute 必须不能和 :other 相互依存。',
    'integer'              => ':attribute 是一个整数。',
    'ip'                   => ':attribute 必须是一个IP地址。',
    'json'                 => ':attribute 必须是一个可解析的数据。',
    'max'                  => [
        'numeric' => ':attribute 必须小于 :max 。',
        'file'    => '上传的文件 (:attribute) 必须小于 :max KB。',
        'string'  => ':attribute 不能多于 :max 位。',
        'array'   => ':attribute 不能多于 :max 个项目。',
    ],
    'mimes'                => '文件后缀 (:attribute) 不被允许。只能上传这些后缀的文件： :values.',
    'min'                  => [
        'numeric' => ':attribute 必须小于 :min.',
        'file'    => '上传的文件(:attribute) 必须小于 :min KB。',
        'string'  => ':attribute 不能对于 :min 位。',
        'array'   => ':attribute 不能多于 :min 个项目。',
    ],
    'not_in'               => ':attribute 是无效的。',
    'numeric'              => ':attribute 必须是数字。',
    'present'              => ':attribute 必须是一个有效的礼物。',
    'regex'                => ':attribute 捕获无效。',
    'required'             => ':attribute 是无效的。',
    'required_if'          => '当 :other 是 :value 的时候，:attribute 是一个无效的值。',
    'required_unless'      => '当 :other 不是 :values 的时候， :attribute 是一个无效的值。',
    'required_with'        => '当 :values 是有效的时候，:attribute 是一个无效的值。',
    'required_with_all'    => '当 :values 是有效的时候，:attribute 的值全部无效。',
    'required_without'     => '当 :values 是无效的时候，:attribute 同样无效。',
    'required_without_all' => '当 :values 是无效的时候，:attribute 都同样无效。',
    'same'                 => ':attribute 和 :other 必须一致。',
    'size'                 => [
        'numeric' => ':attribute 的长度必须是 :size 。',
        'file'    => ':attribute 的大小必须是 :size KB。',
        'string'  => ':attribute 的长度必须是 :size 位。',
        'array'   => ':attribute 必须有 :size 项目。',
    ],
    'string'               => ':attribute 必须是一串数字。',
    'timezone'             => ':attribute 必须是一个有效的时间。',
    'unique'               => ':attribute 必须是一个已经过去的时间',
    'url'                  => ':attribute 必须是一个URL。',

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
            'rule-name' => '用户守则',
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
