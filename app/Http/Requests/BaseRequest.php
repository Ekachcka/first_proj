<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class BaseRequest extends FormRequest
{
    /**
     * @return null
     */
    public function authorize()
    {
        return true;
    }

    /**
     * @param Validator $validator
     * @return void
     * @throws ValidationException
     */
    public function failedValidation(Validator $validator): void
    {
        if (env('APP_DEBUG')===true) {
            $massageError=$validator->getMessageBag()->getMessages();
            $formattedError = [];

            foreach ($massageError as $field=>$message) {
                $formattedError[$field]=$message;
            }

            $response = new JsonResponse($formattedError,400);
        }else{
            $messageError= 'Incorect request data';
            $response = new JsonResponse(["error"=>$messageError],400);
        }
        throw new ValidationException($validator, $response);
    }
}
