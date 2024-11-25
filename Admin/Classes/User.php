<?php
require_once __DIR__ . '/Model.php';

class User extends Model{
    protected $table = "users";
    protected $primary_key = "id_user";

    public function all(){
        return parent::all_data($this->table);
    }
    public function find($id){
        return parent::find_data($id, $this->table, $this->primary_key);
    }
    public function register($datas){

        if(empty($datas['email']) || empty($datas['password']) || empty($datas['username'])){
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

        if($result->num_rows > 0){
            return [
                'status' => false,
                'message' => 'Email sudah terdaftar'
            ];
        } 

        $pass = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO $this->table (username, email, password, phone) VALUES ('$username', '$email', '$pass', '$notelp')";
        $result = mysqli_query($this->db, $sql);

        try{
            if($result){
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

    public function login($datas) {
        $email = $datas['email'];
        $password = $datas['password'];
    

        $stmt = $this->db->prepare("SELECT * FROM $this->table WHERE email = ?");
        $stmt->bind_param("s", $email); // Bind parameter
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