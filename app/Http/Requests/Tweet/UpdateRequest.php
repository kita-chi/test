<?php

namespace App\Http\Requests\Tweet;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'bbb' => 'required|max:140',
            // 'ccc' => 'boolean'
        ];
    }
    public function tweet2(): string
    {
        return $this->input('bbb');
    }

    public function id(): int{
        return (int) $this -> route('tweetId');
    }
}
