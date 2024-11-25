<?php
require_once __DIR__ . '/Model.php';

class Tag extends Model
{
    protected $table = 'tags';
    protected $primary_key = 'tags_id';


    public function create($datas)
    {
        if (empty($datas['name_tag'])) {
            return [
                'status' => false,
                'message' => 'Nama tag tidak boleh kosong!'
            ];
        }

        $result = parent::create_data($datas, $this->table);

        if ($result) {
            return [
                'status' => true,
                'message' => 'Tag berhasil ditambahkan',
                'data' => $result
            ];
        }

    }

    public function all()
    {
        return parent::all_data($this->table) ;
    }

    public function find($id)
    {
        return parent::find_data($id, $this->table, $this->primary_key);
    }

    public function all_paginate($limit, $start)
    {
        return parent::paginate_data($limit, $start, $this->table);
    }

    public function search($keyword, $start = null, $limit = null)
    {
        $queryLimit = '';
        if($start !== null && $limit !== null){
            $queryLimit = " LIMIT $start, $limit";
        }
        $keyword = "WHERE name_tag LIKE '%$keyword%' $queryLimit";
        return parent::search_data($keyword, $this->table);
    }   

    public function edit($id, $datas)
    {
        if (empty($datas['name_tag'])) {
            return [
                'status' => false,
                'message' => 'Nama tag tidak boleh kosong!'
            ];
        }

        $result = parent::update_data($id, $datas, $this->table, $this->primary_key);

        if ($result) {
            return [
                'status' => true,
                'message' => 'Tag berhasil diubah',
                'data' => $result
            ];
        }

        if (!$result) {
            return [
                'status' => false,
                'message' => 'Tag gagal diubah'
            ];
        }
    }

    public function delete($id)
    {
        $result = parent::delete_data($id, $this->table, $this->primary_key);

        if ($result) {
            return [
                'status' => true,
                'message' => 'Tag berhasil dihapus',
                'data' => $result
            ];
        }

        if (!$result) {
            return [
                'status' => false,
                'message' => 'Tag gagal dihapus'
            ];
        }
    }
}
