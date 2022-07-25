<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BattleroyaleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'questions' => QuestionResource::collection($this->battleroyaleQuestions),
        ];
    }
}
