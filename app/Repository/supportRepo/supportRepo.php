<?php

namespace App\Repository\supportRepo;


use App\Models\Panel\Category;
use App\Models\Panel\Support;

class  supportRepo
{
    private $query ;
    public function __construct()
    {
        $this->query = Support::query();
    }

    public function index()
    {
        return $this->query->orderByDesc('created_at')->paginate();
    }

    public function create($value)
    {
        return $this->query->create([
            'title'=> $value->title,
            'link'=> $value->link,
            'content'=> $value->content,
            'user_id'=> auth()->id(),
        ]);
    }

    public function getById($id)
    {
        return $this->query->findOrFail($id);
    }
    public function update($value , $id)
    {
        $id = $this->getById($id);
        return $this->query->where('id' , $id->id)->update([
            'title'=> $value->title ? $value->title : $id->title,
            'link'=> $value->link ? $value->link : $id->link,
            'content'=> $value->content ? $value->content : $id->content,
            'user_id'=> auth()->id(),
        ]);
    }

    public function delete($id)
    {
        $id = $this->getById($id);
        return $this->query->where('id' , $id->id)->delete();
    }

    public function getMultiId( $support_id)
    {
        $support_ids = explode(',', $support_id);
       return  Support::query()->whereIn('id', $support_ids)->get()->pluck('id')->toArray();
    }


}
