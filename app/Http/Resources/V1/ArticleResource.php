<?php
declare(strict_types=1);

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
{
    public  static  $wrap = 'articles';

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
               //structure of our data
            'type' => 'articles',
            'id'   => $this->id(), //calling from model
            'attributes' =>[
                'title'         => $this->title(), //calling from model
                'slug'          => $this->slug(),
                'created_at'    => $this->created_at,
            ],
            'relationship'  =>[
                'author'    => AuthorResource::make($this->author())
            ],
            'links' =>[
                'self'      =>  route('articles.show',$this->id()),
                'related'   =>  route('articles.show',$this->slug())
            ]
        ];
    }

    public function  with($request)
    {
        return [
            'status' =>'success'
        ];
    }

    public  function  withResponse($request, $response)
    {
       $response->header('Accept','application/json');
    }
}
