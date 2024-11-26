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
            ];

            if (!empty($file_data['avatar'])) {
                $avatar = $file_data['avatar'];
                $avatar_name = $avatar['name'];
                $avatar_tmp = $avatar['tmp_name'];
                $avatar_type = $avatar['type'];
                $avatar_size = $avatar['size'];

                $avatar_extension = pathinfo($avatar_name, PATHINFO_EXTENSION);

                if (!in_array($avatar_extension, $allowed_extension)) {
                    return [
                        'status' => false,
                        'message' => 'Format file tidak diizinkan'
                    ];
                }

                if ($avatar_size > 3000000) {
                    return [
                        'status' => false,
                        'message' => 'Ukuran file tidak boleh lebih dari 3MB'
                    ];
                }

                $nama_file_baru = random_int(1000, 9999) . "_" . time() . "." . $avatar_extension;

                if(!file_exists($upload_path)) {
                    mkdir($upload_path, 0777, true);
                }

                if (!move_uploaded_file($avatar_tmp, $upload_path . $nama_file_baru)) {
                    return [
                        'status' => false,
                        'message' => 'Gagal mengupload file!'
                    ];
                }

                $data_to_save['avatar'] = $nama_file_baru;


                if (!empty($current_data['avatar']) && file_exists($upload_path . $current_data['avatar'])) {
                    unlink($upload_path . $current_data['avatar']);
                }
            }


            $result = parent::update_data($id, $data_to_save, $this->table, $this->primary_key);

            if ($result) {
                return [
                    'status' => true,
                    'message' => 'User berhasil diubah',
                    'data' => $result
                ];
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

        $email = $datas['email'];
        $password = $datas['password'];
        $username = $datas['username'];
        $notelp = $datas['phone'];

        $sql = "SELECT * FROM $this->table WHERE email = '$email'";
        $result = mysqli_query($this->db, $sql);

        if ($result->num_rows > 0) {
            return [
                'status' => false,
                'message' => 'Email sudah terdaftar'
            ];
        }

        $pass = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO $this->table (username, email, password, phone) VALUES ('$username', '$email', '$pass', '$notelp')";
        $result = mysqli_query($this->db, $sql);

        try {
            if ($result) {
                $user = mysqli_fetch_assoc($result);
                $_SESSION['id_user'] = $user['id_user'];
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
}