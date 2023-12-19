<?php

namespace App\Http\Requests;

use App\Rules\UniqueSoft;

class EloTeamRequest extends BaseFormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'elo_team_name' => [
                'required',
                'string',
                'max:255',
                new UniqueSoft('elo_teams', 'elo_team_id', $this->elo_team)
            ],
            'is_active' => 'nullable|boolean',
        ];
    }
}
