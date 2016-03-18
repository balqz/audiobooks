<?php namespace App\Repositories;

use App\AudioBook;
use App\Utils\ApiUtils;

class AudioBookRepository extends BaseRepository
{

    public function errors()
    {
        return "AudioBook Error";
    }

    public function all(array $related = null)
    {
        return AudioBook::with($related)->all();
    }

    public function getList($column = NULL, $value = NULL, $sort = '-created_at', $offset = 0, $limit = 20, array $related = null)
    {
        $sort = ApiUtils::parseSorting($sort);

        return AudioBook::with($related)->where($column, $value)->orderBy($sort[0], $sort[1])->offset($offset)->take($limit)->get();
    }

    public function get($id, array $related = null)
    {
        return AudioBook::with($related)->find($id);
    }

    public function getWhere($column, $value, array $related = null)
    {
        return AudioBook::with($related)->where($column, $value)->get();
    }

    public function getRecent($limit, array $related = null)
    {
        return AudioBook::with($related)->orderBy('created_at', 'desc')->take($limit)->get();
    }

    public function create(array $data)
    {
        return AudioBook::create($data);
    }

    public function update(array $data)
    {
        return AudioBook::find($data['id'])->update($data);
    }

    public function delete($id)
    {
        return AudioBook::destroy($id);
    }

    public function deleteWhere($column, $value)
    {
        return AudioBook::where($column, $value)->delete();
    }

}