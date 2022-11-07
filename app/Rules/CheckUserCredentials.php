<?php

namespace App\Rules;

use App\Http\Resources\DefaultResource;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class CheckUserCredentials implements Rule
{
    private $credentials;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(?array $credentials = [])
    {
        $this->credentials = $credentials;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $attempt = Auth::attempt($this->credentials);

        if (!$attempt) {
            throw new HttpResponseException(
                response()->json(['message'=> "Invalid given email or password."], Response::HTTP_BAD_REQUEST)
            );
        }

        return $attempt;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return "You are unauthorized";
    }
}
