<?php

namespace Packages\Server\Repository\Base;

use Illuminate\Support\Facades\DB;

abstract class BaseRepository implements RepositoryInterface
{
    //model muốn tương tác
    protected $model;

    //khởi tạo
    public function __construct()
    {
        $this->setModel();
    }

    //lấy model tương ứng
    abstract public function getModel();

    /**
     * Set model
     */
    public function setModel()
    {
        $this->model = app()->make(
            $this->getModel()
        );
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function create($attributes = [])
    {
        return $this->model->create($attributes);
    }

    public function update($id, $attributes = [])
    {
        $result = $this->find($id);

        if ($result) {
            $result->update($attributes);
            return $result;
        }

        return false;
    }

    public function delete($id)
    {
        $result = $this->find($id);

        if ($result) {
            $result->delete();

            return true;
        }

        return false;
    }

    public function where($conditions)
    {
        return $this->model->where($conditions);
    }

    public function whereRaw(string $query)
    {
        return $this->model->whereRaw($query);
    }

    /**
     * @param array $condition
     * @return mixed
     */
    public function whereFirst(array $condition)
    {
        return $this->model->where($condition)->first();
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function insertGetId(array $data)
    {
        return $this->model->insertGetId($data);
    }

    /**
     * @param string $query
     * @return array
     */
    public function queryRaw(string $query): array
    {
        return DB::select($query);
    }
}
