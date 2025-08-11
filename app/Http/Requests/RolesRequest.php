<?php
namespace App\Http\Requests;



use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class RolesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
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
        return $this->isMethod('POST') ? [
            'name' => ['string', 'required', Rule::unique('roles', 'name')],
            'permissions' => ['array', 'required'],
        ] : [
            'name' => ['string', 'required', Rule::unique('roles', 'name')->ignore(request('role_id'))],
            'permissions' => ['array', 'required'],
        ];
    }

    public function getSanitized()
    {
        $data =  $this->validated();
        if (Auth::guard('web')->check()) {
            $data['guard_name'] = 'web';
        } elseif (Auth::guard('admin')->check()) {
            $data['guard_name'] = 'admin';
        }

        return $data;
    }
}
