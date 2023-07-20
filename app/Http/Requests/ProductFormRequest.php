<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'code' => 'required',
            'name' => 'required',
            'reference' => 'required',
            'category' => 'required',
            'provider' => 'required',
            'service' => 'required',
            'existence' => 'required|numeric',
            'price' => 'required|numeric',
            'discount' => 'required|numeric',
            'description' => 'required',
            'image' => 'required|image|max:500'
        ];
    }

    public function messages()
    {
        return [
            'code.required' => 'El código es obligatorio.',

            'name.required' => 'El nombre es obligatorio.',

            'reference.required' => 'La referencia es obligatoria.',

            'category.required' => 'La categoría es obligatoria.',

            'provider.required' => 'El proveedor es obligatorio.',

            'service.required' => 'El servicio es obligatorio.',

            'existence.required' => 'La existencia es obligatoria.',
            'existence.numeric' => 'La existencia debe tener valores numéricos.',

            'price.required' => 'El precio base es obligatorio.',
            'price.numeric' => 'El precio base debe tener valores numéricos.',

            'discount.required' => 'El descuento es obligatorio.',
            'discount.numeric' => 'El descuento debe tener valores numéricos.',

            'description.required' => 'La descripción es obligatoria.',

            'image.required' => 'La imagen es obligatoria.',
            'image.image' => 'La imagen debe tener extensión PNG o JPG.',
            'image.max' => 'La imagen no debe tener más de 500 kilobytes.'
        ];
    }
}
