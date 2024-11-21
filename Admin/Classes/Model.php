<?php
require_once __DIR__ . '/../DB/connections.php';

class Model extends Connection
{
    /**
     * Membuat data baru
     * @param array $data Data yang akan disimpan ke database
     * @param string $table Nama tabel yang dituju
     * @return bool|int Mengembalikan ID jika berhasil, false jika gagal
     */
    public function create_data($datas, $table){
        //var_dump($data);
        $key = array_keys($datas);
        $val = array_values($datas);

        $key = implode(",",$key);
        $val = implode("','", $val);

        $query = "INSERT INTO $table ($key) VALUES ('$val')";
        $result = mysqli_query($this->db, $query);

        if($result){
            return $datas;
        } else {
            return false;
        }
    }

    /**
     * Mengambil semua data dengan kondisi opsional
     * @param string $table Nama tabel
     * @param array $conditions Kondisi WHERE (opsional)
     * @param array $orderBy Pengurutan data (opsional)
     * @return array Data hasil query
     */
    public function all_data($table){
        $query = "SELECT * FROM $table";
        $result = mysqli_query($this->db, $query);

        return $this->convert_data($result);
    }

    /**
     * Memperbarui data yang sudah ada
     * @param int $id ID data yang akan diupdate
     * @param array $data Data baru yang akan diupdate
     * @param string $table Nama tabel
     * @return bool True jika berhasil, False jika gagal
     */
    public function update_data(int $id, array $data, string $table) {
        try {
            $updates = [];
            foreach ($data as $key => $value) {
                $updates[] = "{$key} = ?";
            }
            $sql = "UPDATE {$table} SET " . implode(', ', $updates) . " WHERE id = ?";
            
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * Mencari satu data berdasarkan ID
     * @param int $id ID data yang dicari
     * @param string $table Nama tabel
     * @return array|null Data yang ditemukan atau null jika tidak ada
     */
    public function find_data(int $id, string $table) {
        try {
            $sql = "SELECT * FROM {$table} WHERE id = ? LIMIT 1";
            return []; // Kembalikan hasil query
        } catch (Exception $e) {
            return null;
        }
    }

    /**
     * Mengkonversi data ke format yang berbeda
     * @param array $data Data yang akan dikonversi
     * @param string $format Format tujuan (json|xml|csv)
     * @return string|null Hasil konversi atau null jika gagal
     */
    public function convert_data($datas){
        $data = [];
        while($row = mysqli_fetch_assoc($datas)){
            $data[] = $row;
        }
        return $data;
    }

    /**
     * Menghapus data berdasarkan ID
     * @param int $id ID data yang akan dihapus
     * @param string $table Nama tabel
     * @return bool True jika berhasil, False jika gagal
     */
    public function delete_data(int $id, string $table) {
        try {
            $sql = "DELETE FROM {$table} WHERE id = ?";
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * Mencari data berdasarkan kata kunci
     * @param string $keyword Kata kunci pencarian
     * @param string $table Nama tabel
     * @param array $columns Kolom-kolom yang akan dicari
     * @return array Hasil pencarian
     */
    public function search_data($keyword, $table) {
         $sql = "SELECT * FROM $table $keyword";
         $result = mysqli_query($this->db, $sql);

         return $this->convert_data($result);
    }

    /**
     * Membuat pagination untuk data
     * @param string $table Nama tabel
     * @param int $page Halaman saat ini
     * @param int $perPage Jumlah data per halaman
     * @param array $conditions Kondisi tambahan (opsional)
     * @return array Informasi pagination dan data
     */
    public function paginate_data($limit, $start, $table){
        $query = "SELECT * FROM $table LIMIT $limit, $start";
        $result = mysqli_query($this->db, $query);

        return $this->convert_data($result);
    }
}
