<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//$user_id = $_SESSION['user_sess_id'];
class Pagination_model extends CI_Model {
function __construct() {
parent::__construct();
}
// Count all record of table "contact_info" in database.
public function record_count() {
//return $this->db->where('to_id',$user_id)->count_all("tbl_email_message");
}

// Fetch data according to per_page limit.
public function fetch_data($limit, $id) {
$this->db->limit($limit);
$this->db->where('id', $id);
$query = $this->db->get("tbl_restaurant");
if ($query->num_rows() > 0) {
foreach ($query->result() as $row) {
$data[] = $row;
}

return $data;
}
return false;
}
}

?>