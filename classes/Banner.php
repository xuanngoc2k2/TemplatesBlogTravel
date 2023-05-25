<?php
    $filepath = realpath(dirname(__FILE__));
    include_once $filepath.'/../lib/database.php';
    include_once $filepath.'/../helper/format.php';
?>
<?php
    class Banner
    {
        private $db;
        private $fm;

        public function __construct()
        {            
            $this->db = new Database();
            $this->fm = new Format();
        }        
        public function insert_banner($data,$files){
            $bannerTitle = $this->fm->validation($data['bannerTitle']);
            $bannerDetail = $this->fm->validation($data['bannerDetail']);
            $bannerType = $this->fm->validation($data['bannerType']);

            $bannerTitle = mysqli_real_escape_string($this->db->link,$bannerTitle);
            $bannerDetail = mysqli_real_escape_string($this->db->link,$bannerDetail);
            $bannerType = mysqli_real_escape_string($this->db->link,$bannerType);

            $permited = array('jpg','jpeg','png','gif');
            $filename = $_FILES['bannerImage']['name'];
            $filesize = $_FILES['bannerImage']['size'];
            $filetemp = $_FILES['bannerImage']['tmp_name'];
            
            $div = explode('.',$filename);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
            $uploaded_image = "uploads/".$unique_image;
            if($bannerTitle=="" || $bannerType=="" || $bannerDetail=="" || $filename==""){
                $alert = "<span style='color: #e74a3b;'>Các trường không được để trống </span>";
                return $alert;
            }
            else{
                if($filesize > 1048567){
                    $alert = "<span style='color: #e74a3b;'>Kích thước hình ảnh phải bé hơn 1MB </span>";
                    return $alert;
                }
                else if(in_array($file_ext,$permited)===false){
                    $alert = "<span style='color: #e74a3b;'>Đinh dạnh ảnh phải là ".implode(', ',$permited)."</span>";
                    return $alert;
                }
                move_uploaded_file($filetemp,$uploaded_image);
                $query = "INSERT INTO tbl_banner(bannerTitle,bannerDetail,bannerImage,bannerType) 
                VALUES('$bannerTitle','$bannerDetail','$unique_image','$bannerType')";
                $result = $this->db->insert($query);
                if($result){
                    $alert = "<span style='color: #1cc88a;'>Thêm banner thành công </span>";
                    return $alert;
                }
                else{
                    $alert = "<span style='color: #e74a3b;'>Thêm banner lỗi </span>";
                    return $alert;
                }
            }
        }  

        public function show_banner()
        {
            $query = "SELECT * FROM tbl_banner";
            $result = $this->db->select($query);
            return $result;
        }

        public function delete_banner($id)
        {
            $query = "DELETE FROM tbl_banner WHERE bannerId = '$id'";
            $result = $this->db->delete($query);
            if($result){
                $alert = "<span style='color: #1cc88a;'>Xóa banner thành công </span>";
                return $alert;
            }
            else{
                $alert = "<span style='color: #e74a3b;'>Xóa banner lỗi </span>";
                return $alert;
            }
        }
        public function getBannerbyId($id) 
        {
            $query = "SELECT * FROM tbl_banner WHERE bannerId = '$id'";
            $result = $this->db->select($query);
            return $result;
        }
        public function update_banner($data,$id)
        {
            $bannerTitle = $this->fm->validation($data['bannerTitle']);
            $bannerDetail = $this->fm->validation($data['bannerDetail']);
            $bannerType = $this->fm->validation($data['bannerType']);

            $bannerTitle = mysqli_real_escape_string($this->db->link,$bannerTitle);
            $bannerDetail = mysqli_real_escape_string($this->db->link,$bannerDetail);
            $bannerType = mysqli_real_escape_string($this->db->link,$bannerType);

            $permited = array('jpg','jpeg','png','gif');
            $filename = $_FILES['bannerImage']['name'];
            $filesize = $_FILES['bannerImage']['size'];
            $filetemp = $_FILES['bannerImage']['tmp_name'];
            
            $div = explode('.',$filename);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
            $uploaded_image = "uploads/".$unique_image;
            if($bannerTitle=="" || $bannerType=="" || $bannerDetail==""){
                $alert = "<span style='color: #e74a3b;'>Các trường không được để trống </span>";
                return $alert;
            }
            else{
                if($filename!=""){
                    if($filesize > 1048567){
                        $alert = "<span style='color: #e74a3b;'>Kích thước hình ảnh phải bé hơn 1MB </span>";
                        return $alert;
                    }
                    else if(in_array($file_ext,$permited)===false){
                        $alert = "<span style='color: #e74a3b;'>Đinh dạnh ảnh phải là ".implode(', ',$permited)."</span>";
                        return $alert;
                    }
                    move_uploaded_file($filetemp,$uploaded_image);
                    $query = "UPDATE tbl_banner
                                SET bannerTitle = '$bannerTitle',
                                    bannerDetail = '$bannerDetail',
                                    bannerImage = '$unique_image',
                                    bannerType = '$bannerType'
                                WHERE bannerId = '$id'";
                    $result = $this->db->update($query);
                    if($result){
                        $alert = "<span style='color: #1cc88a;'>Sửa banner thành công </span>";
                        return $alert;
                    }
                    else{
                        $alert = "<span style='color: #e74a3b;'>Sửa banner lỗi </span>";
                        return $alert;
                    }
                }
                else{
                    $query = "UPDATE tbl_banner
                                SET bannerTitle = '$bannerTitle',
                                    bannerDetail = '$bannerDetail',
                                    bannerType = '$bannerType'
                                WHERE bannerId = '$id'";
                    $result = $this->db->update($query);
                    if($result){
                        $alert = "<span style='color: #1cc88a;'>Sửa banner thành công </span>";
                        return $alert;
                    }
                    else{
                        $alert = "<span style='color: #e74a3b;'>Sửa banner lỗi </span>";
                        return $alert;
                    }
                }
            }
        }
        public function bannerShow(){
            $query = "SELECT * FROM tbl_banner WHERE bannerType = 0";
            $result = $this->db->select($query);
            return $result;
        }
    }
?>