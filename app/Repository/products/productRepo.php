<?php

namespace App\Repository\products;

use App\Models\Panel\Product;

class productRepo
{
    private $query ;
    public function __construct(){
      $this->query = Product::query() ;
    }

    public function index()
    {
        return $this->query->orderByDesc('created_at')->paginate() ;
    }

    public function create($value)
    {
        return $this->query->create([

        ]) ;
    }

    public function getFindId($id)
    {
        return $this->query->findOrFail($id) ;
    }

    public function update($value , $id )
    {
        $id = $this->getFindId($id);
        return $this->query->where('id' , $id->id)->update([

        ]) ;
    }

    public function delete($id)
    {
        return $this->query->where('id' , $id->id)->delete() ;
    }
}
