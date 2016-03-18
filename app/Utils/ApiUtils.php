<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 18/03/16
 * Time: 11:27
 */

namespace App\Utils;


use Illuminate\Database\Eloquent\Builder;

class ApiUtils
{

    public static function parseSorting($sort)
    {
        $order = substr($sort, 0, 1);
        if ($order == '-') {
            $order = 'desc';
        } else {
            $order = 'asc';
        }

        $sortBy = substr($sort, 1, strlen($sort) - 1);

        return array($sortBy, $order);
    }

    public static function parseRelated($related)
    {
        if ($related == NULL) return NULL;
        return explode(",", $related);
    }

    public static function getList(Builder $builder)
    {
        $sort = self::parseSorting(request()->get('sort', '-created_at'));
        $offset = request()->get('offset', '0');
        $limit = request()->get('limit', '20');
        $related = self::parseRelated(request()->get('fields'));
        $column = NULL;
        $value = NULL;

        if ($column != NULL && $value != NULL) {
            $builder->where($column, $value);
        }
        if ($related != NULL) {
            $builder->with($related);
        }

        return $builder->orderBy($sort[0], $sort[1])->offset($offset)->take($limit)->get();
    }

    public static function get(Builder $builder, $id)
    {
        return $builder->find($id);
    }

}