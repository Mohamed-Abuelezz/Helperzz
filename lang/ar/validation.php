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


    'email' => 'حقل :attribute يجب ان يكون بريد اليكتروني .',
    'numeric' => ' الحقل :attribute يجب ان يكون رقم .',
    'required' => 'الحقل :attribute مطلوب .',
    'image' => 'الحقل :attribute يجب ان يكون صورة .',
    'mimes' => 'الحقل :attribute يجب ان يكون ملف نوعه :values .',
    'unique' => 'ال :attribute تم استخدامه من قبل.',
    'uploaded' => 'ال :attribute فشل التحميل .',
    'confirmed' => 'تأكيد :attribute غير مطابق.',

    'max' => [
        'array' => 'الحقل :attribute لايجب ان يكون اكثر من :max عنصر.',
        'file' => 'الحقل :attribute لايجب ان يكون اكثر من :max kilobytes.',
        'numeric' => 'الحقل :attribute لايجب ان يكون اكثر من :max .',
        'string' => 'الحقل :attribute لايجب ان يكون اكثر من :max حرف.',
    ],
    'min' => [
        'array' => 'الحقل :attribute يجب ان يكون علي الاقل :min عنصر.',
        'file' => 'الحقل :attribute يجب ان يكون علي الاقل :min kilobytes.',
        'numeric' => 'الحقل :attribute يجب ان يكون علي الاقل :min .',
        'string' => 'الحقل :attribute يجب ان يكون علي الاقل :min حرف.',
    ],
    'gt' => [
        'array' => 'The :attribute must have more than :value items.',
        'file' => 'The :attribute must be greater than :value kilobytes.',
        'numeric' => 'The :attribute must be greater than :value.',
        'string' => 'The :attribute must be greater than :value characters.',
    ],
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
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
