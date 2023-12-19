<?php

namespace App\Http\Requests;

use App\Rules\UniqueSoft;


class EmployeeRequest extends BaseFormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'first_name' => 'required|max:255',
            'first_surname' => 'required|max:255',
            'second_surname' => 'required|max:255',
            'gender' => 'required|in:M,F',
            'NSS' => [
                'required',
                'string',
                'max:11',
                'min:11',
                new UniqueSoft('employees', 'employee_id', $this->employee)
            ],
            'RFC' => [
                'required',
                'string',
                'size:13',
                'min:13',
                'max:13',
                new UniqueSoft('employees', 'employee_id', $this->employee)
            ],
            'CURP' => [
                'required',
                'string',
                'size:18',
                'min:18',
                'max:18',
                new UniqueSoft('employees', 'employee_id', $this->employee)
            ],
            'contract_type_id' => 'required|exists:contract_types,contract_type_id,deleted_at,NULL',
            'salary_type_id' => 'required|exists:salary_types,salary_type_id,deleted_at,NULL',
            'workday_type_id' => 'required|exists:workday_types,workday_type_id,deleted_at,NULL',
            'SDI' => 'required|numeric',
            'hire_date' => 'required|date',
            'birth_date' => 'required|date',
            'job_id' => 'required|exists:jobs,job_id,deleted_at,NULL',
            'UMF' => 'required|max:5',
            'nationality' => 'required|max:50',
            'birth_country' => 'required|min:3|max:3',
            'birth_state_code' => 'required|min:3|max:5',
            'birth_city' => 'required|max:50',
            'address_country' => 'required|size:3',
            'address_state_code' => 'required|min:3|max:5',
            'address_city' => 'required|max:50',
            'address_zipcode' => 'required|min:4|max:6',
            'address_description' => 'required|max:255',
            'address_lat' => 'nullable|numeric',
            'address_lng' => 'nullable|numeric',
            'marital_status' => 'required|max:50',
            'employee_status_id' => 'required|exists:employee_statuses,employee_status_id,deleted_at,NULL',
            'email' => [
                'required',
                'email',
                'max:50',
                new UniqueSoft('employees', 'employee_id', $this->employee)
            ],
            'last_update_by' => 'nullable|max:36',
            'elo_team_id' => 'nullable|exists:elo_teams,elo_team_id,deleted_at,NULL',
            'cost_center_id' => 'nullable|numeric',
            'phone_number' => 'nullable|min:7|max:14',
            'image_file' => 'nullable|string'
        ];
    }
}
