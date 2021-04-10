<?php

namespace App\Http\Resources\Product;

//use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductCollection extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'stock' => $this->stock == 0 ? 'Out Of Stock' : $this->stock,
            'totalPrice' => round((1-($this->discount/100)) * $this->price),
            'rating' => $this->review->count() > 0 ? round($this->review->sum('star')/$this->review->count(),2) : 'No Rating Yet',
            'href' => [
                        'review' => route('reviews.index',$this->id)
                    ]
        ];
    }
}
