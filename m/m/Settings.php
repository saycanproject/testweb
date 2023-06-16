<?php
class Settings {

    private $db;

    public function __construct() {
        $this->db = new DB();
    }

    public function setOption($business_id, $option_value, $created_by, $json_options = null) {
        $business_id = $this->db->escape($business_id);
        $option_value = $this->db->escape($option_value);
        $json_options = $this->db->escape(json_encode($json_options));
        $created_by = $this->db->escape($created_by);

        $sql = "INSERT INTO settings (option_name, option_value, json_options, created_by)
                VALUES ('$business_id', '$option_value', '$json_options', '$created_by')";

        return $this->db->query($sql);
    }

    public function getOptionStatus($business_id) {
        $business_id = $this->db->escape($business_id);

        $result = $this->db->query("SELECT option_value FROM settings WHERE option_name = '{$business_id}'");

        if ($result->num_rows > 0) {
            $row = $result->row;
            return $row['option_value'];
        } else {
            return false;
        }
    }
    
    public function getJsonOptions($option_name) {
        $sql = "SELECT json_options 
                FROM settings 
                WHERE option_name = '{$option_name}'";

        $result = $this->db->query($sql);

        if ($result && $result->num_rows > 0) {
            $row = $result->row;
            $json_options = json_decode($row['json_options'], true);

            return $json_options;
        }

        return false;
    }
}
?>