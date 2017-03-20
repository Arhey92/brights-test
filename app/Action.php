<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Action extends Model
{
    protected $fillable = [
        'title',
        'status',
        'url'
    ];

    public function create($title, $status, $url)
    {
        $this->title = $title;
        $this->status = $status;
        $this->url = $url;
        $this->save();
    }
}
