<?php

namespace App\Http\Requests\post;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Spatie\Backtrace\File;

class PutRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        if($this->expectsJson())
        {
            $response = new Response($validator->errors(),422);
            throw new ValidationException($validator,$response);
        }  
    }

    /*
    protected function prepareForValidation()
    {
        $this->merge([
            //'slug'=>Str::of($this->title)->slug()->append('-aditional'),
            "slug"=>str($this->title)->slug(),
        ]);
    }
    */

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        //dd($this->route('post')->id);
        //dd($this->route('post'));

        return [
            "title"         =>  "required|min:5|max:500",
            "slug"          =>  "min:5|max:500|unique:posts,slug,".$this->route('post')->id,
            "content"       =>  "required|min:7",
            "category_id"   =>  "required|integer",
            "description"   =>  "required|min:7",
            "posted"        =>  "required",
            "image"         =>  "mimes:jpeg,jpg,png",
            //"image"         =>  ["mimes:jpeg,jpg,png",File::image()->max(12*1024)],
        ];
    }

    public function messages()
    {
        return[
            'title.required'=>'El campo :attribute es obligatorio.',
            'title.min'=>'El campo :attribute debe tener al menos :min caracteres',
            'title.max'=>'El campo :attribute debe tener maximo :max caracteres',
        ];
    }
}
