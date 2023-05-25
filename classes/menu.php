<?php
    $filepath = realpath(dirname(__FILE__));
    include_once $filepath.'/../lib/database.php';
    include_once $filepath.'/../helper/format.php';
?>
<?php
    class menu
    {
        private $db;
        private $fm;

        public function __construct()
        {            
            $this->db = new Database();
            $this->fm = new Format();
        }
        public function insert_menu($data){
            $menuName = $this->fm->validation($data['menuName']);
            $menutype = $this->fm->validation($data['menutype']);

            $menuName = mysqli_real_escape_string($this->db->link,$menuName);
            $menutype = mysqli_real_escape_string($this->db->link,$menutype);

            if($menuName=="" || $menutype==""){
                $alert = "<span style='color: #e74a3b;'>Các trường không được để trống </span>";
                return $alert;
            }
            else{
                $query = "INSERT INTO tbl_menu(menuName,menuType) VALUES('$menuName','$menutype')";
                $result = $this->db->insert($query);
                if($result){
                    $alert = "<span style='color: #1cc88a;'>Thêm menu thành công </span>";
                    return $alert;
                }
                else{
                    $alert = "<span style='color: #e74a3b;'>Thêm menu lỗi </span>";
                    return $alert;
                }
            }
        }  
        
        public function show_menu(){
            $query = "SELECT * FROM tbl_menu ORDER BY menuId desc";
            $result_menu = $this->db->select($query);
            return $result_menu;
        }

        public function menu_show(){
            $query = "SELECT * FROM tbl_menu WHERE menuType=0 ORDER BY menuId asc ";
            $result_menu = $this->db->select($query);
            return $result_menu;
        }


        public function getMenubyId($id){
            $query = "SELECT * FROM tbl_menu WHERE menuId='$id'";
            $result_menu = $this->db->select($query);
            return $result_menu;
        }

        public function update_menu($data,$id){
            $menuName = $this->fm->validation($data['menuName']);
            $menutype = $this->fm->validation($data['menutype']);

            $menuName = mysqli_real_escape_string($this->db->link,$menuName);
            $menutype = mysqli_real_escape_string($this->db->link,$menutype);
            $menuId = mysqli_real_escape_string($this->db->link,$id);

            if($menuName=="" || $menutype==""){
                $alert = "<span style='color: #e74a3b;'>Các trường không được để trống </span>";
                return $alert;
            }
            else{
                $query = "UPDATE tbl_menu SET menuName = '$menuName',
                                              menuType = '$menutype'
                                        WHERE menuId = '$id'";
                $result = $this->db->update($query);
                if($result){
                    $alert = "<span style='color: #1cc88a;'>Sửa menu thành công </span>";
                    return $alert;
                }
                else{
                    $alert = "<span style='color: #e74a3b;'>Sửa menu lỗi </span>";
                    return $alert;
                }
            }
        }
        public function delete_menu($id){
            $query = "DELETE FROM tbl_menu WHERE menuId='$id'";
            $result_menu = $this->db->delete($query);
            if($result_menu){
                $alert = "<span style='color: #1cc88a;'>Xóa menu thành công </span>";
                return $alert;
            }
            else{
                $alert = "<span style='color: #e74a3b;'>Xóa menu lỗi </span>";
                return $alert;
            }
        }
    }
?>