<?php
    $filepath = realpath(dirname(__FILE__));
    include_once $filepath.'/../lib/database.php';
    include_once $filepath.'/../helper/format.php';
?>
<?php
    class Blog
    {
        private $db;
        private $fm;

        public function __construct()
        {            
            $this->db = new Database();
            $this->fm = new Format();
        }
        public function insertBlog($data)
        {
            $blogTitle = $this->fm->validation($data['blogTitle']);
            $blogDetail = $this->fm->validation($data['blogDetail']);
            $blogType = $this->fm->validation($data['blogType']);

            $blogTitle = mysqli_real_escape_string($this->db->link,$blogTitle);
            $blogDetail = mysqli_real_escape_string($this->db->link,$blogDetail);
            $blogType = mysqli_real_escape_string($this->db->link,$blogType);

            $permited = array('jpg','jpeg','png','gif');
            $filename = $_FILES['blogImage']['name'];
            $filesize = $_FILES['blogImage']['size'];
            $filetemp = $_FILES['blogImage']['tmp_name'];
            
            $div = explode('.',$filename);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
            $uploaded_image = "uploads/".$unique_image;
            if($blogTitle=="" || $blogType=="" || $blogDetail=="" || $filename==""){
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
                $query = "INSERT INTO tbl_blog(blogTitle,blogDetail,blogImage,blogType) 
                VALUES('$blogTitle','$blogDetail','$unique_image','$blogType')";
                $result = $this->db->insert($query);
                if($result){
                    $alert = "<span style='color: #1cc88a;'>Thêm blog thành công </span>";
                    return $alert;
                }
                else{
                    $alert = "<span style='color: #e74a3b;'>Thêm blog lỗi </span>";
                    return $alert;
                }
            }
        }
        public function show_blog()
        {
            $query = "SELECT * from tbl_blog";
            $result = $this->db->insert($query);
            return $result;
        }
        public function delete_blog($id)
        {
            $query = "DELETE from tbl_blog WHERE blogId = '$id'";
            $result = $this->db->delete($query);
            if($result){
                $alert = "<span style='color: #1cc88a;'>Xóa blog thành công</span>";
                return $alert;
            }
            else{
                $alert = "<span style='color: #e74a3b;'>Xóa blog lỗi</span>";
                return $alert;
            }
        }
        public function update_blog($data,$id)
        {
            $blogTitle = $this->fm->validation($data['blogTitle']);
            $blogDetail = $this->fm->validation($data['blogDetail']);
            $blogType = $this->fm->validation($data['blogType']);

            $blogTitle = mysqli_real_escape_string($this->db->link,$blogTitle);
            $blogDetail = mysqli_real_escape_string($this->db->link,$blogDetail);
            $blogType = mysqli_real_escape_string($this->db->link,$blogType);

            $permited = array('jpg','jpeg','png','gif');
            $filename = $_FILES['blogImage']['name'];
            $filesize = $_FILES['blogImage']['size'];
            $filetemp = $_FILES['blogImage']['tmp_name'];
            
            $div = explode('.',$filename);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
            $uploaded_image = "uploads/".$unique_image;
            if($blogTitle=="" || $blogType=="" || $blogDetail==""){
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
                    $query = "UPDATE tbl_blog
                                SET blogTitle = '$blogTitle',
                                    blogDetail = '$blogDetail',
                                    blogImage = '$unique_image',
                                    blogType = '$blogType'
                                WHERE blogId = '$id'";
                    $result = $this->db->update($query);
                    if($result){
                        $alert = "<span style='color: #1cc88a;'>Sửa blog thành công </span>";
                        return $alert;
                    }
                    else{
                        $alert = "<span style='color: #e74a3b;'>Sửa blog lỗi </span>";
                        return $alert;
                    }
                }
                else{
                    $query = "UPDATE tbl_blog
                                SET blogTitle = '$blogTitle',
                                    blogDetail = '$blogDetail',
                                    blogType = '$blogType'
                                WHERE blogId = '$id'";
                    $result = $this->db->update($query);
                    if($result){
                        $alert = "<span style='color: #1cc88a;'>Sửa blog thành công </span>";
                        return $alert;
                    }
                    else{
                        $alert = "<span style='color: #e74a3b;'>Sửa blog lỗi </span>";
                        return $alert;
                    }
                }
            }
        }
        public function getBlogbyId($id)    
        {
            $query = "SELECT * from tbl_blog Where blogId='$id'";
            $result = $this->db->select($query);
            return $result;
        }
        public function blogShow()
        {
            $query = "SELECT * from tbl_blog Where blogType != 2";
            $result = $this->db->select($query);
            return $result;
        }
    }
?>