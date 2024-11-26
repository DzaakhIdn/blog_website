<?php
require_once __DIR__ . '/Model.php';

class Post extends Model
{
    protected $table = 'blog_posts';
    protected $primary_key = 'id_post';

    public function all()
    {
        return parent::all_data($this->table);
    }
    public function find($id)
    {
        return parent::find_data($id, $this->table, $this->primary_key);
    }
    public function delete($id)
    {
        return parent::delete_data($id, $this->table, $this->primary_key);
    }

    public function create($data)
    {
        if (empty($data)) {
            return [
                'status' => false,
                'message' => 'Artikel tidak boleh kosong!'
            ];
        }

        $artikel_konten = isset($data['content']) ? $data['content'] : "";
        
        return parent::create_data($data, $this->table);
    }
}