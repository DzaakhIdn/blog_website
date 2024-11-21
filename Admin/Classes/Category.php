<?php
require_once __DIR__ . '/Model.php';

class Category extends Model {
    private $table = 'categories';

    public function create_category(array $post_data, array $file_data) {

        if (empty($post_data['name_category'])) {
            return [
                'status' => false,
                'message' => 'Nama kategori tidak boleh kosong!'
            ];
        }

        if (!isset($file_data["category_img"]) || $file_data["category_img"]["error"] === 4) {
            return [
                'status' => false,
                'message' => 'File gambar harus diupload!'
            ];
        }

        $nama_file = $file_data["category_img"]["name"];
        $file_size = $file_data["category_img"]["size"];
        $tmp_name = $file_data["category_img"]["tmp_name"];
        $file_extension = strtolower(pathinfo($nama_file, PATHINFO_EXTENSION));
        $allowed_extension = ["jpg", "jpeg", "gif", "svg", "png", "webp", "avif"];


        if (!in_array($file_extension, $allowed_extension)) {
            return [
                'status' => false,
                'message' => 'Ekstensi file tidak diizinkan!'
            ];
        }

        if ($file_size > 5120000) {
            return [
                'status' => false,
                'message' => 'Ukuran file terlalu besar! Maksimal 5MB'
            ];
        }

        try {
            $nama_file = random_int(1000, 9999) . "_" . time() . "." . $file_extension;
            $upload_path = "/var/www/html/blog-web/public/img/category_img/";
            

            if (!file_exists($upload_path)) {
                mkdir($upload_path, 0777, true);
            }

            // Upload file
            if (!move_uploaded_file($tmp_name, $upload_path . $nama_file)) {
                return [
                    'status' => false,
                    'message' => 'Gagal mengupload file!'
                ];
            }

            $data_to_save = [
                'name_category' => $post_data['name_category'],
                'category_img' => $nama_file
            ];
            
            $result = parent::create_data($data_to_save, $this->table);
            
            if ($result) {
                return [
                    'status' => true,
                    'message' => 'Kategori berhasil ditambahkan',
                    'data' => $result
                ];
            }

            unlink($upload_path . $nama_file);
            return [
                'status' => false,
                'message' => 'Gagal menyimpan data kategori'
            ];

        } catch (Exception $e) {
            return [
                'status' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ];
        }
    }

    public function all(){
         return parent::all_data($this->table);
    }
    
    public function all_paginate($limit, $start){
        return parent::paginate_data($limit, $start, $this->table);
    }

    public function search($keyword, $start = null, $limit = null){
        $queryLimit = '';
        if($start !== null && $limit !== null){
            $queryLimit = " LIMIT $start, $limit";
        }
        $keyword = "WHERE name_category LIKE '%$keyword%' $queryLimit";
        return parent::search_data($keyword, $this->table);
    }
}

