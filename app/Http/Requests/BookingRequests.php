<?php namespace app\Http\Requests;

use app\Http\Requests\Request;

class BookingRequests extends Request {

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
     * @return array
     */
    public function rules()
    {
        return [
            'month'  =>  'required|integer',
            'day'    =>  'required|integer',
            'full_name'  =>  'required|string',
            'class'      =>  'string',
            'student_id' =>  'string',
            'email'      =>  'required|email',
            'start_time' =>  'required|date_format:"H:i"|before:end_time',
            'end_time'   =>  'required|date_format:"H:i"',
        ];
    }

}
