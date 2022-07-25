<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class QuestionResource extends JsonResource
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
            'question' => $this->question,
            'photo' => env('PUBLIC_URL') . $this->photo,
            'video' => env('PUBLIC_URL') . $this->video,
            'answers' => AnswerResource::collection(($this->battle_id ? $this->battleQuestionAnswer : $this->battleroyaleQuestionAnswer)),
        ];
    }
}
