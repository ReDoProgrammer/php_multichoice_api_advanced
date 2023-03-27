<?php
class Database
{
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "multichoice_advanced";


    private $mysqli = "";
    private $result = array();
    private $conn = false;

    //hàm dựng/ hàm khởi tạo: chạy đầu tiên khi class đc gọi
    public function __construct()
    {
        if (!$this->conn) {
            $this->mysqli = new mysqli(
                $this->host,
                $this->username,
                $this->password,
                $this->database
            );
            $this->conn = true;

            if ($this->mysqli->connect_error) {
                array_push($this->result, $this->mysqli_connection_error);
                return false;
            }
        } else {
            return true;
        }
    }


    /*
    Những hàm dưới đây được khai báo 1 cách tổng quát
    Có thể áp dụng cho bất cứ table nào
    Cụ thể:
        $table là tên table trong csdl
        $params là mảng gồm các phần tử theo định dạng: key=>value
        tương tự với các từ khóa như join, where,order mặc định là null
    */


    // hàm thêm dữ liệu
    public function insert($table, $params = array())
    {
        if ($this->tableExist($table)) {
            $table_column = implode(', ', array_keys($params));
            $table_value = implode("', '", array_values($params));

            $sql = "INSERT INTO $table ($table_column) VALUES ('$table_value')";
            if ($this->mysqli->query($sql)) {
                array_push($this->result, true);
                return true;
            } else {
                array_push($this->result, false);
                return false;
            }
        } else {
            return false;
        }
    }

    // hàm lấy dữ liệu
    public function select($table, $row = "*", $join = null, $where = null, $order = null,$skip=null, $limit = null)
    {
        if ($this->tableExist($table)) {
            $sql = "SELECT $row FROM $table";
            if ($join != null) {
                $sql .= " ".$join;
            }
            if ($where != null) {
                $sql .= " WHERE $where";
            }
            if ($order != null) {
                $sql .= " ORDER BY $order";
            }
            
            if ($limit != null) {
                $sql .= " LIMIT ".($skip==null?0:$skip).", $limit";
            }
            $query = $this->mysqli->query($sql);
            if ($query) {
                $this->result = $query->fetch_all(MYSQLI_ASSOC);
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    //Hàm trả về tổng số dòng của câu select để tính số trang
    public function total($table, $row = "*", $join = null, $where = null)
    {
        if ($this->tableExist($table)) {
            $sql = "SELECT COUNT($row) as Total FROM $table";
            if ($join != null) {
                $sql .= " $join";
            }
            if ($where != null) {
                $sql .= " WHERE $where";
            }          
            $query = $this->mysqli->query($sql);
            if ($query) {
                $this->result = $query->fetch_all(MYSQLI_ASSOC);
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    //hàm cập nhật dữ liệu
    public function update($table, $params = array(), $where = null)
    {
        if ($this->tableExist($table)) {
            $arg = array();
            foreach ($params as $key => $val) {
                $arg[] = "$key = '{$val}'";
            }
            $sql = "UPDATE $table SET " . implode(', ', $arg);
            if ($where != null) {
                $sql .= " WHERE $where";
            }
            if ($this->mysqli->query($sql)) {
                array_push($this->result, true);
                return true;
            } else {
                array_push($this->result, false);
                return false;
            }
        } else {
            return false;
        }
    }
    // hàm xóa dữ liệu
    public function delete($table, $where = null)
    {
        if ($this->tableExist($table)) {
            $sql = "DELETE FROM $table";
            if ($where != null) {
                $sql .= " WHERE $where";
            }
            if ($this->mysqli->query($sql)) {
                array_push($this->result, true);
                return true;
            } else {
                array_push($this->result, false);
                return false;
            }
        } else {
            return false;
        }
    }
    // hàm kiểm tra bảng trong csdl có tồn tại hay không
    private function tableExist($table)
    {
        $sql = "SHOW TABLES FROM $this->database LIKE '{$table}'";
        $tableInDb = $this->mysqli->query($sql);
        if ($tableInDb) {
            if ($tableInDb->num_rows == 1) {
                return true;
            } else {
                array_push($this->result, $table . " Does not Exist");
            }
        } else {
            return false;
        }
    }

    // hàm lấy kết quả
    public function getResult()
    {
        $val = $this->result;
        $this->result = array();
        return $val;
    }

    // hàm đóng kết nối
    public function __destruct()
    {
        if ($this->conn) {
            if ($this->mysqli->close()) {
                $this->conn = false;
                return true;
            }
        } else {
            return false;
        }
    }
}
?>