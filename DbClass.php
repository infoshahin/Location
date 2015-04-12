<?php

/**
 * Description of DbClass
 *
 * @author Anowar
 * @date 07-April-2015
 */
class DbClass {

    private $data;
    public $count = 1;

    public $division_id = 1;
    public function __construct() {
        mysql_connect('localhost', 'root', '') or die('connect error');
        mysql_select_db('location') or die('Select error');
    }

    public function selectIdByName($sql) {
        $query = mysql_query($sql) or die('query errror: ' . mysql_error());
        if (mysql_num_rows($query) == 1) {
            $data = mysql_fetch_assoc($query);
            return $data['LOCATION_ID'];
        } else {
            return false;
        }
    }

    public function insert($sql) {
        $query = mysql_query($sql) or die('query errror: ' . mysql_error());
        return mysql_insert_id();
    }

    public function insertThis($data) {
//        print_r($data);
//        exit();
        $sql1 = "SELECT LOCATION_ID FROM tbl_location WHERE LOCATION_NAME='$data[0]' AND LOCATION_TYPE='1'";
        $sql2 = "SELECT LOCATION_ID FROM tbl_location WHERE LOCATION_NAME='$data[1]' AND LOCATION_TYPE='2'";
        $sql3 = "SELECT LOCATION_ID FROM tbl_location WHERE LOCATION_NAME='$data[2]' AND LOCATION_TYPE='3'";
        $sql4 = "SELECT LOCATION_ID FROM tbl_location WHERE LOCATION_NAME='$data[3]' AND LOCATION_TYPE='4'";

        $this->data['dis_id'] = $this->selectIdByName($sql1);
        $this->data['thana_id'] = $this->selectIdByName($sql2);
        $this->data['sub_id'] = $this->selectIdByName($sql3);
        $this->data['post_id'] = $this->selectIdByName($sql4);

        if (!$this->data['dis_id']) {
            $sql = "INSERT INTO tbl_location (`LOCATION_NAME`,`LOCATION_TYPE`,`PARENT_ID`) VALUES('$data[0]','1','$this->division_id')";
            $this->data['dis_id'] = $this->insert($sql);
        }
        if (!$this->data['thana_id']) {
            $sql = "INSERT INTO tbl_location (`LOCATION_NAME`,`LOCATION_TYPE`,`PARENT_ID`) VALUES('$data[1]','2'," . $this->data['dis_id'] . ")";
            $this->data['thana_id'] = $this->insert($sql);
        }
        if (!$this->data['sub_id']) {
            $sql = "INSERT INTO tbl_location (`LOCATION_NAME`,`LOCATION_TYPE`,`PARENT_ID`) VALUES('$data[2]','3'," . $this->data['thana_id'] . ")";
            $this->data['sub_id'] = $this->insert($sql);
        }
        if (!$this->data['post_id']) {
            $sql = "INSERT INTO tbl_location (`LOCATION_NAME`,`LOCATION_TYPE`,`PARENT_ID`) VALUES('$data[3]','4'," . $this->data['sub_id'] . ")";
            $this->data['post_id'] = $this->insert($sql);
        }

        $this->count++;
//        print_r($this->data);
//        echo '<hr/>';
    }

}
