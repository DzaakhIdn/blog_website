<?php
require_once __DIR__ . '/Model.php';

class User extends Model
{
    protected $table = "users";
    protected $primary_key = "id_user";

    public function all()
    {
        return parent::all_data($this->table);
    }
    public function find($id)
    {
        return parent::find_data($id, $this->table, $this->primary_key);
    }


    public function update_profile($id, $post_data, $file_data = null)
    {
        $allowed_extension = ["jpg", "jpeg", "gif", "svg", "png", "webp", "avif"];
        $upload_path = "/var/www/html/blog-web/public/img/profile/";
        $upload_path_banner = "/var/www/html/blog-web/public/img/banner/";

        try {
            $current_data = parent::find_data($id, $this->table, $this->primary_key);
            if (!$current_data) {
                return [
                    'status' => false,
                    'message' => 'Data kategori tidak ditemukan'
                ];
            }

            $data_to_save = [
                'username' => $post_data['username'],
                'email' => $post_data['email'],
                'phone' => $post_data['phone'],
                'bio' => $post_data['bio'],
                'address' => $post_data['address'],
                'gender' => $post_data['gender'],
                'job' => $post_data['job']
            ];

            if (isset($file_data['avatar'])) {
                $data_to_save['avatar'] = parent::handleFileUpload($file_data['avatar'], $upload_path, $allowed_extension, $current_data['avatar'] ?? null);
            }

            if (isset($file_data['banner'])) {
                $data_to_save['banner'] = parent::handleFileUpload($file_data['banner'], $upload_path_banner, $allowed_extension, $current_data['banner'] ?? null);
            }

            if ($file_data['error'] !== UPLOAD_ERR_OK) {
                switch ($file_data['error']) {
                    case UPLOAD_ERR_INI_SIZE:
                    case UPLOAD_ERR_FORM_SIZE:
                        throw new Exception('Ukuran file terlalu besar');
                    case UPLOAD_ERR_PARTIAL:
                        throw new Exception('File hanya terupload sebagian');
                    case UPLOAD_ERR_NO_FILE:
                        throw new Exception('Tidak ada file yang diupload');
                    case UPLOAD_ERR_NO_TMP_DIR:
                        throw new Exception('Direktori sementara hilang');
                    case UPLOAD_ERR_CANT_WRITE:
                        throw new Exception('Gagal menulis file ke disk');
                    default:
                        throw new Exception('Kesalahan tidak diketahui');
                }
            }


            if (!file_exists($upload_path)) {
                throw new Exception('Path upload tidak ditemukan: ' . $upload_path);
            }

            if (!move_uploaded_file($file_data['banner']['tmp_name'], $upload_path . 'test_file.jpg')) {
                throw new Exception('Gagal memindahkan file: ' . error_get_last()['message']);
            }


            $result = parent::update_data($id, $data_to_save, $this->table, $this->primary_key);

            if ($file_data['error'] !== UPLOAD_ERR_OK) {
                switch ($file_data['error']) {
                    case UPLOAD_ERR_INI_SIZE:
                    case UPLOAD_ERR_FORM_SIZE:
                        throw new Exception('Ukuran file terlalu besar');
                    case UPLOAD_ERR_PARTIAL:
                        throw new Exception('File hanya terupload sebagian');
                    case UPLOAD_ERR_NO_FILE:
                        throw new Exception('Tidak ada file yang diupload');
                    case UPLOAD_ERR_NO_TMP_DIR:
                        throw new Exception('Direktori sementara hilang');
                    case UPLOAD_ERR_CANT_WRITE:
                        throw new Exception('Gagal menulis file ke disk');
                    default:
                        throw new Exception('Kesalahan tidak diketahui');
                }
            }


            if (!file_exists($upload_path)) {
                throw new Exception('Path upload tidak ditemukan: ' . $upload_path);
            }

            if (!move_uploaded_file($file_data['banner']['tmp_name'], $upload_path . 'test_file.jpg')) {
                throw new Exception('Gagal memindahkan file: ' . error_get_last()['message']);
            }

            if ($result) {
                return [
                    'status' => true,
                    'message' => 'User berhasil diubah',
                    'data' => $result
                ];
            }

            if (isset($data_to_save['banner']) && file_exists($upload_path_banner . $data_to_save['banner'])) {
                unlink($upload_path_banner . $data_to_save['banner']);
            }

            if (isset($data_to_save['avatar']) && file_exists($upload_path . $data_to_save['avatar'])) {
                unlink($upload_path . $data_to_save['avatar']);
            }

            return [
                'status' => false,
                'message' => 'Gagal menyimpan data user'
            ];
        } catch (Exception $e) {
            return [
                'status' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ];
        }
    }

    public function register($datas)
    {

        if (empty($datas['email']) || empty($datas['password']) || empty($datas['username'])) {
            return [
                'status' => false,
                'message' => 'Data tidak boleh kosong'
            ];
        }

        $email = mysqli_real_escape_string($this->db, $datas['email']);
        $password = mysqli_real_escape_string($this->db, $datas['password']);
        $username = mysqli_real_escape_string($this->db, $datas['username']);
        $notelp = mysqli_real_escape_string($this->db, $datas['phone']);

        $sql = "SELECT * FROM $this->table WHERE email = '$email'";
        $result = mysqli_query($this->db, $sql);

        if (mysqli_num_rows($result) > 0) {
            return [
                'status' => false,
                'message' => 'Email sudah terdaftar'
            ];
        }

        $pass = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO $this->table (username, email, password, phone) VALUES ('$username', '$email', '$pass', '$notelp')";
        $result = mysqli_query($this->db, $sql);

        try {
            if (!$result) {
                return [
                    'status' => false,
                    'message' => 'Terjadi kesalahan: ' . mysqli_error($this->db)
                ];
            }
            if ($result) {
                $user = mysqli_insert_id($this->db);
                $_SESSION['id_user'] = $user;
                $_SESSION['username'] = $username;
                $_SESSION['email'] = $email;
                $_SESSION['phone'] = $notelp;

                $full_data = [
                    'username' => $username,
                    'email' => $email,
                    'phone' => $notelp
                ];

                return [
                    'status' => true,
                    'message' => 'Register Berhasil',
                    'data' => $full_data
                ];
            }
        } catch (Exception $e) {
            return [
                'status' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ];
        }
    }

    public function login($datas)
    {
        $email = $datas['email'];
        $password = $datas['password'];


        $stmt = $this->db->prepare("SELECT * FROM $this->table WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();

            if (password_verify($password, $user['password'])) {

                $_SESSION['id_user'] = $user['id_user'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['phone'] = $user['phone'];

                return [
                    'status' => true,
                    'message' => 'Login Berhasil'
                ];
            } else {
                return [
                    'status' => false,
                    'message' => 'Password salah'
                ];
            }
        } else {
            return [
                'status' => false,
                'message' => 'Email tidak ditemukan'
            ];
        }
    }

    public function logout()
    {
        session_destroy();
        return [
            'status' => true,
            'message' => 'Logout Berhasil'
        ];
    }

    public function top_user()
    {
        $sql = "SELECT
    users.*,
    SUM(blog_posts.views) AS total_views,
    COUNT(blog_posts.id_post) AS total_posts
FROM
    users
LEFT JOIN blog_posts ON users.id_user = blog_posts.user_id
GROUP BY
    users.id_user
ORDER BY
    total_posts
DESC";
        $result = $this->db->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
