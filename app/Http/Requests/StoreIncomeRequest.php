<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreIncomeRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'category_id' => 'nullable|exists:categories,id',
            'amount' => 'required|numeric|min:0.01',
            'date' => 'required|date',
            'payer' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ];
    }
}

