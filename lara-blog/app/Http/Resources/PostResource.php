<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        
        return [
            
            "user" => new UserResource($this->author),
            "comments" => CommentResource::collection($this->comments),
            "id" => $this->id,
            "title" => $this->title,
            "slug" => $this->slug,
            "img_path" => $this->img,
            "body" => $this->body,
            "created_at" => $this->created_at->diffForHumans(),
            "updated_at" => $this->updated_at->diffForHumans(),

        ];
    }
}
