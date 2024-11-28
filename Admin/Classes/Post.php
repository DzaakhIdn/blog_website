<?php
require_once __DIR__ . '/../DB/connections.php';
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
    public function all_paginate($start, $limit)
    {
        return parent::paginate_data($limit, $start, $this->table);
    }

    public function create($post_data, $file_data)
    {
        if (empty($post_data) && empty($file_data)) {
            return ['status' => false, 'message' => 'Artikel tidak boleh kosong!'];
        }

        // Validasi gambar utama
        if (!isset($file_data["image_url"]) || $file_data["image_url"]["error"] === 4) {
            return ['status' => false, 'message' => 'Gambar artikel tidak boleh kosong!'];
        }

        $nama_file = $file_data["image_url"]["name"];
        $file_size = $file_data["image_url"]["size"];
        $tmp_name = $file_data["image_url"]["tmp_name"];
        $file_extension = strtolower(pathinfo($nama_file, PATHINFO_EXTENSION));
        $allowed_extension = ["jpg", "jpeg", "gif", "svg", "png", "webp", "avif"];

        if (!in_array($file_extension, $allowed_extension)) {
            return ['status' => false, 'message' => 'Ekstensi file tidak diizinkan!'];
        }

        if ($file_size > 5120000) {
            return ['status' => false, 'message' => 'Ukuran file terlalu besar! Maksimal 5MB'];
        }

        $upload_dir = '/var/www/html/blog-web/public/img/post_img/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        $nama_img_artikel = uniqid() . '_' . preg_replace('/[^\w\-]/', '_', $post_data['title']) . '.' . $file_extension;
        $upload_path = $upload_dir . $nama_img_artikel;

        if (!move_uploaded_file($tmp_name, $upload_path)) {
            return ['status' => false, 'message' => 'Gagal mengupload gambar'];
        }

        $data_to_save = [
            'user_id' => $_SESSION['id_user'],
            'title' => $post_data['title'],
            'id_category' => $post_data['id_category'],
            'image_url' => $nama_img_artikel
        ];

        $artikel_konten = $post_data['content'] ?? '';

        // Proses gambar base64
        preg_match_all('/<img[^>]+src="data:image\/([^;]+);base64,([^"]+)"[^>]*>/', $artikel_konten, $matches, PREG_SET_ORDER);

        foreach ($matches as $match) {
            $image = base64_decode($match[2]);
            $image_extension = $match[1];
            $image_name = uniqid() . '.' . $image_extension;
            $image_path = $upload_dir . $image_name;

            if (file_put_contents($image_path, $image)) {
                $artikel_konten = str_replace($match[0], '<img src="/img/post_img/' . $image_name . '" alt="Image">', $artikel_konten);
            } else {
                return ['status' => false, 'message' => 'Gagal menyimpan gambar'];
            }
        }

        $clean_html = htmlspecialchars($artikel_konten, ENT_QUOTES, 'UTF-8');

        $data_to_save['content'] = $clean_html;
        $result = parent::create_data($data_to_save, $this->table);


        $tags = $_POST["tags"] ? $_POST["tags"] : [];
        $post_id = $this->db->insert_id;

        if (!$post_id) {
            return ['status' => false, 'message' => 'Gagal menyimpan artikel'];
        }

        $tag_ids = [];

        foreach ($tags as $tag) {
            $tag = trim($tag);
            if (!is_string($tag) || empty($tag)) {
                continue;
            }

            if (ctype_digit($tag)) {
                continue;
            }
            $sql_check = "SELECT tags_id FROM tags WHERE name_tag = '" . $tag . "'";
            $result_check = mysqli_query($this->db, $sql_check);
            $exiting_tag = mysqli_fetch_assoc($result_check);

            if ($exiting_tag) {
                $tag_ids[] = $exiting_tag["tags_id"];
            } else {
                $sql_insert = "INSERT INTO tags (name_tag) VALUES ('" . $tag . "')";
                $result_insert = mysqli_query($this->db, $sql_insert);
                $tag_ids[] = mysqli_insert_id($this->db);
            }
        }

        foreach ($tag_ids as $tag_id) {
            $insert_sql = "INSERT INTO pivot_post_tags (post_id_pivot, tag_id_pivot) VALUES ($post_id, $tag_id)";
            $result_insert = mysqli_query($this->db, $insert_sql);
        }

        if (!$result_insert) {
            return ['status' => false, 'message' => 'Gagal menyimpan artikel'];
        }

        if ($result) {
            return ['status' => true, 'message' => 'Artikel berhasil ditambahkan', 'data' => $result];
        }

        return ['status' => false, 'message' => 'Gagal menyimpan artikel'];
    }

    public function all_paginate2($id, $start = null, $limit = null)
    {
        $sqlLimit = '';
        if ($start !== null && $limit !== null) {
            $sqlLimit = " LIMIT $start, $limit";
        }
        $sql = "SELECT 
        blog_posts.id_post, 
        blog_posts.content, 
        blog_posts.image_url, 
        blog_posts.title, 
        categories.name_category, 
        blog_posts.user_id, 
        users.username, 
        users.avatar, 
        GROUP_CONCAT(tags.name_tag SEPARATOR ', ') AS tags
    FROM 
        blog_posts 
    JOIN 
        categories ON blog_posts.id_category = categories.category_id 
    JOIN 
        users ON blog_posts.user_id = users.id_user 
    JOIN 
        pivot_post_tags ON pivot_post_tags.post_id_pivot = blog_posts.id_post 
    JOIN 
        tags ON pivot_post_tags.tag_id_pivot = tags.tags_id 
    WHERE 
        blog_posts.user_id = '$id'
    GROUP BY 
        blog_posts.id_post, 
        blog_posts.content, 
        blog_posts.image_url, 
        blog_posts.title, 
        categories.name_category, 
        blog_posts.user_id, 
        users.username, 
        users.avatar" . $sqlLimit;

        $result = $this->db->query($sql)->fetch_all(MYSQLI_ASSOC);
        return $result;
    }
}
