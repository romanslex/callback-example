<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class OrdersResponseModel extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "data" => $this->collection->map(function ($order) {
                return [
                    "id" => $order->id,
                    "created_at" => $order->created_at->format("d.m.Y в H:i"),
                    "site" => $order->widget->url,
                    "phone" => $order->phone
                ];
            })
        ];
    }
}
