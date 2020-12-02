<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VoteStatisticsResource extends JsonResource
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
            'daily_average' => round($this->dailyAverage, 2),
            'weekly_average' => round($this->weeklyAverage, 2),
            'monthly_average' => round($this->monthlyAverage, 2)
        ];
    }
}
