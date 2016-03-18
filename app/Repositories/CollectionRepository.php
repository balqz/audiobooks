<?php namespace App\Repositories;

class CollectionRepository extends BaseRepository
{

    public function errors()
    {
        return "Collection Error";
    }

    public function all(array $related = null)
    {
        return App\Collection::with($related)->all();
    }

    public function get($id, array $related = null)
    {
    	return App\Collection::with($related)->find($id);
    }

    public function getWhere($column, $value, array $related = null)
    {
        return App\Collection::with($related)->where($column, $value)->get();
    }

    public function getRecent($limit, array $related = null){
        return App\Collection::with($related)->orderBy('created_at', 'desc')->take($limit)->get();
    }

    public function create(array $data)
    {
        return App\Collection::create($data);
    }

    public function update(array $data){
        return App\Collection::find($data['id'])->update($data);
    }

    public function delete($id)
    {
        return App\Collection::destroy($id);
    }

    public function deleteWhere($column, $value)
    {
        return App\Collection::where($column, $value)->delete();
    }

}