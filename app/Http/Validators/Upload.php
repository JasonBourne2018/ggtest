<?php
namespace App\Http\Validators;

class Upload {

    static public function rules() {
        return [
            'file' => [
                'bail',
                'required',
                'file',
                'image',
                'max:' . (5 * 1024 * 1024) //5M
            ]
        ];
    }

    static public function attributes() {
        return [
        ];
    }

    static public function messages() {
        return [
            'file.max' => '文件超过5M',
            'file.image' => '只能上传图片',
            'file.file' => '不正确的文件',
            'file.required' => '请选择文件',
        ];
    }

}
