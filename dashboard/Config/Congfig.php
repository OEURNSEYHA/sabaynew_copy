<?php
    // $localhost = "localhost";
    // $root = "root";
    // $password = "";
    // $database = "secondproject";
    // $cn = new mysqli($localhost, $root, $password, $database);
    include('Database.php');
    class Database extends DB{
       
        public $cn;
        public $lastid;
        
        function config(){
            $this -> cn = new mysqli(
               $this -> host,
               $this -> root,
               $this -> password,
               $this -> database
            );
        }

        function  __construct(){
            $this->config();
        }
        
        function insert($table,$value){
            $sql = "INSERT INTO $table VALUES($value)";
            $this->cn->query($sql);
            $this -> lastid = $this->cn->insert_id;
        }

        function update($table, $column, $row){
            $sql = "UPDATE $table SET $column WHERE $row";
            $this ->cn->query($sql);
        }

        function Duplicate($table,$column,$row){
            $sql = "SELECT $column FROM $table WHERE $row ";
            $result = $this -> cn -> query($sql);
            if($result -> num_rows > 0){
                return true;
            }else{
                return false;
            }
        }

        function  realescapstring ($column){
            return $this -> cn->real_escape_string($column);
        }


        function countdata($table, $condition){
            $sql = "SELECT COUNT(*) AS total FROM $table WHERE $condition";
            $resultcount = $this-> cn-> query($sql);
            $rowcount = $resultcount -> fetch_array();
            return $rowcount[0];
        }
        

        function GetData($table,$column1,$column2,$start,$end,$condition){
            $data = array();
            $sql = "SELECT $column1 FROM $table  WHERE $condition ORDER BY $column2 DESC LIMIT $start,$end";
            $result = $this-> cn->query($sql);
            if($result->num_rows > 0){
                while($row = $result->fetch_array()){
                    $data[]= $row;
                }
                return $data;
            }else{
                return 0;
            }
            
        }

        function GetCurrentData($table,$column1,$column2){
            
            $sql = "SELECT $column1 FROM $table WHERE $column2";
            $result = $this->cn->query($sql);
            $row = $result ->fetch_array();
          
            return $row;
            
        }

        function slugStr($str){
            return preg_replace("#(\p{P}|\p{C}|\p{S}|\p{Z})+#u","-", $str);
        } 

        public function get_post_date($time,$date){
            $previousTimeStamp = strtotime($time." ".$date);
            $lastTimeStamp = strtotime(date("Y-m-d h:i:sa"));
            $menos=$lastTimeStamp-$previousTimeStamp;
            $mins=$menos/60;
            if($mins<1){
                $showing= "អប្បិញមិញ";
            }
            else{
                $minsfinal=floor($mins);
                $secondsfinal=$menos-($minsfinal*60);
                $hours=$minsfinal/60;
            if($hours<1){
                $showing= $minsfinal . " នាទីមុន";
            }
            else{
                $hoursfinal=floor($hours);
                $minssuperfinal=$minsfinal-($hoursfinal*60);
                $days=$hoursfinal/24;
            if($days<1){
                $showing= $hoursfinal . " ម៉ោងមុន";
            }
            else if($days<2)
            {
                $showing=" ម្សិលមិញ ម៉ោង ".$time;
            }
            else{
                $d=date("d",strtotime($date));
                $m=date("m",strtotime($date));
                $y=date("Y",strtotime($date));
            if($m==1)
            {
                $m='មករា';
            }
            else if($m==2)
            {
                $m='កុម្ភៈ';      
            }
            else if($m==3)
            {
                $m='មីនា';      
            }
            else if($m==4)
            {
                $m='មេសា';      
            }
            else if($m==5)
            {
                $m='ឧសភា';      
            }
            else if($m==6)
            {
                $m='មិថុនា';      
            }
            else if($m==7)
            {
                $m='កក្តដា';      
            }
            else if($m==8)
            {
                $m='សីហា';      
            }
            else if($m==9)
            {
                $m='កញ្ញា';      
            }
            else if($m==10)
            {
                $m='តុលា';    
            }
            else if($m==11)
            {
                $m='វិច្ឆិកា';      
            }
            else if($m==12)
            {
                $m='ធ្នូ';      
            }
                $showing=$d."-".$m."-".$y ." - ម៉ោង ". $time;
            }}}
            return $showing;  
        }
        
        

      

            
    }
    
?>