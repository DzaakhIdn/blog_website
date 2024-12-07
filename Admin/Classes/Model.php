<?php
require_once __DIR__ . '/../DB/connections.php';

class Model extends Connection
{
    public function create_data($datas, $table)
    {
        //var_dump($data);
        $key = array_keys($datas);
        $val = array_values($datas);

        $key = implode(",", $key);
        $val = implode("','", $val);

        $query = "INSERT INTO $table ($key) VALUES ('$val')";
        $result = mysqli_query($this->db, $query);

        if ($result) {
            return $datas;
        } else {
            return false;
        }
    }

    public function all_data($table)
    {
        $query = "SELECT * FROM $table";
        $result = mysqli_query($this->db, $query);

        return $this->convert_data($result);
    }

    public function update_data($id, $datas, $table, $column)
    {
        $key = array_keys($datas);
        $val = array_values($datas);

        $query = "UPDATE $table SET ";

        for ($i = 0; $i < count($key); $i++) {
            $query .= $key[$i] . " = '" . $val[$i] . "'";
            if ($i != count($key) - 1) {
                $query .= " , ";
            }
        }

        $query .= " WHERE {$column} = $id";
        $result = mysqli_query($this->db, $query);
        if ($result) {
            return $datas;
        } else {
            return false;
        }
    }

    public function find_data($id, $table, $column)
    {
        $query = "SELECT * FROM $table WHERE {$column} = $id";
        $result = mysqli_query($this->db, $query);
        $data = $this->convert_data($result);
        if ($result->num_rows > 0) {
            return $data;
        } else {
            echo "ga ada data dengan id $id ";
        }
    }

    public function convert_data($datas)
    {
        $data = [];
        while ($row = mysqli_fetch_assoc($datas)) {
            $data[] = $row;
        }
        return $data;
    }

    public function delete_data($id, $table, $column)
    {
        $query = "DELETE FROM $table WHERE {$column} = $id";
        $result = mysqli_query($this->db, $query);
        return $result;
    }

    public function search_data($keyword, $table)
    {
        $sql = "SELECT * FROM $table $keyword";
        $result = mysqli_query($this->db, $sql);

        return $this->convert_data($result);
    }

    public function paginate_data($limit, $start, $table)
    {
        $query = "SELECT * FROM $table LIMIT $limit, $start";
        $result = mysqli_query($this->db, $query);

        return $this->convert_data($result);
    }

    public function all_filter($id_user, $table, $newwst = null, $views = null)
    {
        // Validasi parameter
        $allowed_sort_columns = ['created_at', 'views', 'updated_at']; // Contoh kolom yang diizinkan
        $allowed_views = ['ASC', 'DESC'];

        // Pastikan `$newwst` valid
        if ($newwst !== null && !in_array($newwst, $allowed_sort_columns)) {
            $newwst = null;
        }

        // Pastikan `$views` valid
        if ($views !== null && !in_array($views, $allowed_views)) {
            $views = null;
        }

        // Query dasar
        $query = "SELECT * FROM $table WHERE user_id = '$id_user'";

        // Tambahkan pengurutan jika diperlukan
        if ($newwst !== null) {
            $query .= " ORDER BY $newwst";
            if ($views !== null) {
                $query .= " $views";
            }
        }

        $result = mysqli_query($this->db, $query);

        // Periksa jika query gagal
        if (!$result) {
            die("Query gagal: " . mysqli_error($this->db));
        }

        return $this->convert_data($result);
    }

    public function cek_atmin()
    {
        $sql = "SELECT * FROM users WHERE id_user = 10 AND role = 'admin'";
        $result = mysqli_query($this->db, $sql);

        return $this->convert_data($result);
    }

    public function handleFileUpload($file, $upload_path, $allowed_extension, $current_file = null)
    {
        $allowed_mime_types = ['image/jpeg', 'image/png', 'image/gif', 'image/webp', 'image/svg+xml', 'image/avif'];

        // Validasi file upload
        if (empty($file['tmp_name']) || !is_uploaded_file($file['tmp_name'])) {
            throw new Exception('File tidak valid atau gagal diunggah');
        }

        $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

        if (!in_array($extension, $allowed_extension)) {
            throw new Exception('Format file tidak diizinkan');
        }

        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime_type = finfo_file($finfo, $file['tmp_name']);
        finfo_close($finfo);

        if (!in_array($mime_type, $allowed_mime_types)) {
            throw new Exception('Tipe MIME file tidak diizinkan');
        }

        // Generate nama file baru
        $new_file_name = random_int(1000, 9999) . "_" . time() . "." . $extension;

        // Cek dan buat folder jika tidak ada
        if (!file_exists($upload_path)) {
            if (!mkdir($upload_path, 0777, true) && !is_dir($upload_path)) {
                throw new Exception('Gagal membuat direktori upload');
            }
        }

        // Pindahkan file ke direktori tujuan
        if (!move_uploaded_file($file['tmp_name'], $upload_path . $new_file_name)) {
            throw new Exception('Gagal mengupload file');
        }

        // Hapus file lama jika ada
        if (!empty($current_file) && file_exists($upload_path . $current_file)) {
            unlink($upload_path . $current_file);
        }

        return $new_file_name;
    }
}
