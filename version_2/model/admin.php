<?php

include_once 'adb.php';

class admin extends adb{

    function admin(){}

    /**
     * @param $admin_id
     * @param $fname
     * @param $sname
     * @param $district
     * @param $phone
     * @return bool
     */
    function add_admin($admin_id, $fname, $sname, $district, $phone){
        $str_query =  "INSERT into se_admin SET
                   admin_id = $admin_id,
                   fname = '$fname',
                   sname = '$sname',
                   district = $district,
                   phone = '$phone'";

        return $this->query($str_query);
    }


    /**
     * @param $admin_id
     * @param $fname
     * @param $sname
     * @param $district
     * @param $phone
     * @return bool
     */
    function update_admin_details($admin_id, $fname, $sname, $district, $phone){
        $str_query = "UPDATE se_admin SET
                   fname = '$fname',
                   sname = '$sname',
                   district = $district,
                   phone = '$phone'
                WHERE admin_id = $admin_id";

        return $this->query($str_query);
    }

    /**
     * @param $admin_id
     * @param $district
     * @return bool
     */
    function update_district($admin_id, $district){
        $str_query = "UPDATE se_admin SET
                   district = $district
                WHERE admin_id = $admin_id";

        return $this->query($str_query);
    }




    function get_details($admin_id){
        $str_query = "SELECT * FROM se_admin
                WHERE adminname = $admin_id";

        return $this->query($str_query);
    }

}

$obj = new admin();
$obj->update_district(1, 3);



?>
