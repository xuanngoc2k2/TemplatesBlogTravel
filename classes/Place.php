<?php
    $filepath = realpath(dirname(__FILE__));
    include_once $filepath.'/../lib/database.php';
    include_once $filepath.'/../helper/format.php';
?>
<?php
    class Place
    {
        private $db;
        private $fm;

        public function __construct()
        {            
            $this->db = new Database();
            $this->fm = new Format();
        }
        public function insertPlace($data,$files)
        {
            $placeName = $this->fm->validation($data['placeName']);
            $Country = $this->fm->validation($data['Country']);
            $placeType = $this->fm->validation($data['placeType']);
            $star = $this->fm->validation($data['star']);

            $placeName = mysqli_real_escape_string($this->db->link,$placeName);
            $Country = mysqli_real_escape_string($this->db->link,$Country);
            $placeType = mysqli_real_escape_string($this->db->link,$placeType);
            $star= mysqli_real_escape_string($this->db->link,$star);

            $permited = array('jpg','jpeg','png','gif');
            $filename = $_FILES['placeImage']['name'];
            $filesize = $_FILES['placeImage']['size'];
            $filetemp = $_FILES['placeImage']['tmp_name'];
            
            $div = explode('.',$filename);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
            $uploaded_image = "uploads/".$unique_image;
            if($placeName=="" || $placeType=="" || $Country=="" || $filename=="" || $star==""){
                $alert = "<span style='color: #e74a3b;'>Các trường không được để trống </span>";
                return $alert;
            }
            else if(!is_numeric($star)){
                $alert = "<span style='color: #e74a3b;'>Điểm đánh giá phải là số !! </span>";
                return $alert;
            }
            else if($star >5){
                $alert = "<span style='color: #e74a3b;'>Điểm đánh giá phải nhỏ hơn hoặc bằng 5 !! </span>";
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
                $query = "INSERT INTO tbl_place(placeName,Country,star,placeType,placeImage) 
                VALUES('$placeName','$Country','$star','$placeType','$unique_image')";
                $result = $this->db->insert($query);
                if($result){
                    $alert = "<span style='color: #1cc88a;'>Thêm place thành công </span>";
                    return $alert;
                }
                else{
                    $alert = "<span style='color: #e74a3b;'>Thêm place lỗi </span>";
                    return $alert;
                }
            }
        }
        public function show_place()
        {
            $query = "SELECT * from tbl_place";
            $result = $this->db->insert($query);
            return $result;
        }
        public function delete_place($id)
        {
            $query = "DELETE from tbl_place WHERE placeId = '$id'";
            $result = $this->db->delete($query);
            if($result){
                $alert = "<span style='color: #1cc88a;'>Xóa place thành công</span>";
                return $alert;
            }
            else{
                $alert = "<span style='color: #e74a3b;'>Xóa place lỗi</span>";
                return $alert;
            }
        }
        public function update_place($data,$id)
        {
            $placeName = $this->fm->validation($data['placeName']);
            $Country = $this->fm->validation($data['Country']);
            $placeType = $this->fm->validation($data['placeType']);
            $star = $this->fm->validation($data['star']);

            $placeName = mysqli_real_escape_string($this->db->link,$placeName);
            $Country = mysqli_real_escape_string($this->db->link,$Country);
            $placeType = mysqli_real_escape_string($this->db->link,$placeType);
            $star= mysqli_real_escape_string($this->db->link,$star);

            $permited = array('jpg','jpeg','png','gif');
            $filename = $_FILES['placeImage']['name'];
            $filesize = $_FILES['placeImage']['size'];
            $filetemp = $_FILES['placeImage']['tmp_name'];
            
            $div = explode('.',$filename);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
            $uploaded_image = "uploads/".$unique_image;

            if($placeName=="" || $placeType=="" || $Country=="" || $star==""){
                $alert = "<span style='color: #e74a3b;'>Các trường không được để trống </span>";
                return $alert;
            }
            else if(!is_numeric($star)){
                $alert = "<span style='color: #e74a3b;'>Điểm đánh giá phải là số !! </span>";
                return $alert;
            }
            else if($star >5){
                $alert = "<span style='color: #e74a3b;'>Điểm đánh giá phải nhỏ hơn hoặc bằng 5 !! </span>";
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
                    $query = "UPDATE tbl_place
                                SET placeName = '$placeName',
                                    Country = '$Country',
                                    placeImage = '$unique_image',
                                    star = '$star',
                                    placeType = '$placeType'
                                WHERE placeId = '$id'";
                    $result = $this->db->update($query);
                    if($result){
                        $alert = "<span style='color: #1cc88a;'>Sửa place thành công </span>";
                        return $alert;
                    }
                    else{
                        $alert = "<span style='color: #e74a3b;'>Sửa place lỗi </span>";
                        return $alert;
                    }
                }
                else{
                    $query = "UPDATE tbl_place
                                SET placeName = '$placeName',
                                    Country = '$Country',
                                    star = '$star',
                                    placeType = '$placeType'
                                WHERE placeId = '$id'";
                    $result = $this->db->update($query);
                    if($result){
                        $alert = "<span style='color: #1cc88a;'>Sửa place thành công </span>";
                        return $alert;
                    }
                    else{
                        $alert = "<span style='color: #e74a3b;'>Sửa place lỗi </span>";
                        return $alert;
                    }
                }
            }
        }
        public function getPlacebyId($id)    
        {
            $query = "SELECT * from tbl_place Where placeId='$id'";
            $result = $this->db->select($query);
            return $result;
        }
        public function placeShow()
        {
            $query = "SELECT * from tbl_place Where placeType =0";
            $result = $this->db->select($query);
            return $result;
        }
    }
?>