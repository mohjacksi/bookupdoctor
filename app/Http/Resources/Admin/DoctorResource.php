<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

class DoctorResource extends JsonResource
{
    public function toArray($request)
    {
        $array = parent::toArray($request);
        unset($array['links'], $array['meta'], $array['first_page_url'],
        $array['last_page_url'], $array['next_page_url'],
        $array['prev_page_url'], $array['path']);
        return $array;
    }
}
