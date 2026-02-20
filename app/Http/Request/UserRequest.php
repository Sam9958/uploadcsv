<?php
namespace App\Http\Request;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Validator as fascvalidator;
class UserRequest extends FormRequest
{
    public function __construct()
    {

    }
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            "csv_file" => "nullable|file"
        ];
    }

    public function withValidator(Validator $validator)
    {
        $validator->after(function ($validator) {
            $pth = $this->path();
            $extrarules = [];
            if ($pth == "api/upload_csv") {
                $extrarules = [
                    "csv_file" => "required|file|mimes:csv|max:2048"
                ];
            }
            if (!empty($extrarules)) {
                $extravalidator = fascvalidator::make($this->all(), $extrarules);
                if ($extravalidator->fails()) {
                    foreach ($extravalidator->errors()->messages() as $field => $messages) {
                        foreach ($messages as $msg) {
                            $validator->errors()->add($field, $msg);
                        }
                    }
                }
            }
        });
    }


    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                "status" => false,
                "status_key" => "ERRPR",
                "status_code" => 422,
                "message" => "validation failed",
                "error" => $validator->errors()
            ])
        );
    }

}