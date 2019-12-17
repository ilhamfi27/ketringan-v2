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

    'accepted'          => ':attribute harus diterima.',
    'active_url'        => ':attribute bukan URL yang valid.',
    'after'             => 'Tanggal :attribute harus sesudah tanggal :date.',
    'after_or_equal'    => 'Tanggal :attribute harus sama atau sesudah :date.',
    'alpha'             => ':attribute hanya boleh berisi huruf.',
    'alpha_dash'        => ':attribute hanya boleh berisi huruf, angka, dash (-) dan underscore (_).',
    'alpha_num'         => ':attribute hanya boleh berisi huruf dan angka.',
    'array'             => ':attribute harus berisi array.',
    'before'            => 'Tanggal :attribute harus sebelum tangal :date.',
    'before_or_equal'   => 'Tanggal :attribute harus sama atau sebelum :date.',
    'between' => [
        'numeric'       => ':attribute harus di antara :min dan :max.',
        'file'          => ':attribute harus di antara :min dan :max kilobyte.',
        'string'        => ':attribute harus di antara :min dan :max karakter.',
        'array'         => ':attribute harus ada di antara :min dan :max item.',
    ],
    'boolean'           => ':attribute harus berisi benar atau salah.',
    'confirmed'         => 'konfirmasi :attribute tidak sama.',
    'date'              => ':attribute bukan tanggal yang benar.',
    'date_equals'       => ':attribute harus sama dengan tanggal :date.',
    'date_format'       => 'Format :attribute tidak sama dengan format :format.',
    'different'         => ':attribute dan :other harus berbeda.',
    'digits'            => ':attribute harus :digits digit.',
    'digits_between'    => ':attribute harus diantara :min dan :max digit.',
    'dimensions'        => ':attribute dimensi gambar tidak valid.',
    'distinct'          => 'Isi dari :attribute memiliki nilai duplikat.',
    'email'             => ':attribute harus berisi alamat email yang valid.',
    'exists'            => ':attribute yang dipilih tidak tersedia.',
    'file'              => ':attribute harus berisi sebuah file.',
    'filled'            => ':attribute harus berisi sebuah nilai.',
    'gt' => [
        'numeric'       => ':attribute harus lebih besar dari :value.',
        'file'          => ':attribute harus lebih besar dari :value kilobite.',
        'string'        => ':attribute harus lebih besar dari :value karakter.',
        'array'         => ':attribute harus memilki lebih dari :value item.',
    ],
    'gte' => [
        'numeric'       => ':attribute harus lebih besar dari atau sama dengan :value.',
        'file'          => ':attribute harus lebih besar dari atau sama dengan :value kilobite.',
        'string'        => ':attribute harus lebih besar dari atau sama dengan :value karakter.',
        'array'         => ':attribute harus memiliki :value item atau lebih.',
    ],
    'image'             => ':attribute harus berisi gambar.',
    'in'                => ':attribute yang dipilih tidak tersedia.',
    'in_array'          => 'Isi dari :attribute tidak ada di dalam :other.',
    'integer'           => ':attribute harus berisi sebuah integer.',
    'ip'                => ':attribute harus berisi sebuah IP address yang valid.',
    'ipv4'              => ':attribute harus berisi sebuah IPv4 address yang valid.',
    'ipv6'              => ':attribute harus berisi sebuah IPv6 address yang valid.',
    'json'              => ':attribute harus berisi sebuah JSON string yang valid.',
    'lt' => [
        'numeric'       => ':attribute harus kurang dari :value.',
        'file'          => ':attribute harus kurang dari :value kilobytes.',
        'string'        => ':attribute harus kurang dari :value characters.',
        'array'         => ':attribute harus memilki kurang dari :value item.',
    ],
    'lte' => [
        'numeric'       => ':attribute harus kurang dari atau sama dengan :value.',
        'file'          => ':attribute harus kurang dari atau sama dengan :value kilobytes.',
        'string'        => ':attribute harus kurang dari atau sama dengan :value characters.',
        'array'         => ':attribute tidak boleh lebih banyak dari :value item.',
    ],
    'max' => [
        'numeric'       => ':attribute tidak lebih besar dari :max.',
        'file'          => ':attribute tidak lebih besar dari :max kilobite.',
        'string'        => ':attribute tidak lebih besar dari :max karakter.',
        'array'         => ':attribute tidak lebih banyak dari :max item.',
    ],
    'mimes'             => ':attribute harus sebuah file dengan tipe: :values.',
    'mimetypes'         => ':attribute harus sebuah file dengan tipe: :values.',
    'min' => [
        'numeric'       => ':attribute harus berisi setidaknya :min.',
        'file'          => ':attribute harus berisi setidaknya :min kilobite.',
        'string'        => ':attribute harus berisi setidaknya :min karakter.',
        'array'         => ':attribute harus memiliki setidaknya :min item.',
    ],
    'not_in'            => ':attribute yang dipilih tidak tersedia.',
    'not_regex'         => 'Format :attribute salah.',
    'numeric'           => ':attribute harus berisi angka.',
    'present'           => ':attribute harus ada.',
    'regex'             => 'Format :attribute salah.',
    'required'          => ':attribute dibutuhkan.',
    'required_if'       => ':attribute dibutuhkan ketika :other bernilai :value.',
    'required_unless'   => ':attribute dibutuhkan kecuali :other ada dalam :values.',
    'required_with'     => ':attribute dibutuhkan ketika :values ada.',
    'required_with_all' => ':attribute dibutuhkan ketika :values ada.',
    'required_without'  => ':attribute dibutuhkan ketika :values tidak ada.',
    'required_without_all' => ':attribute dibutuhkan ketika tidak ada nilai dari :values.',
    'same' => ':attribute dan :other harus sama.',
    'size' => [
        'numeric'       => ':attribute harus berisi :size.',
        'file'          => ':attribute harus berisi :size kilobite.',
        'string'        => ':attribute harus berisi :size karakter.',
        'array'         => ':attribute harus terdapat :size item.',
    ],
    'starts_with'       => ':attribute harus diawali dengan: :values',
    'string'            => ':attribute harus berisi string.',
    'timezone'          => ':attribute harus berisi waktu zona valid.',
    'unique'            => ':attribute sudah digunakan.',
    'uploaded'          => ':attribute gagal di-upload.',
    'url'               => ':attribute format salah.',
    'uuid'              => ':attribute harus berisi UUID yang valid.',

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
