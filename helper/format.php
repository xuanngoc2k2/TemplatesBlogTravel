<?php 
    class Format{
        public function textShorten($text,$Limit = 400){
            if (strlen($text) > $Limit) {
                $text = substr($text, 0, $Limit);
                $text = substr($text, 0, strrpos($text, ' ')); 
                $text .= '...';
            }
            return $text;
        }
        public function validation($data){
            $data = trim($data);
            $data = stripcslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

    }
?>