<?php	
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/Database.php');
	include_once ($filepath.'/../helpers/Format.php');
?>
<?php 

class brand
{
	
	private $db;
	private $fm;
	function __construct()
	{
		$this->db = new Database();
		$this->fm = new Format();
	}
	public function brandinsert($brandName){
		$brandName = $this->fm->validation($brandName);

		$brandName = mysqli_real_escape_string($this->db->link,$brandName);
		if (empty($brandName)) {
			$msg = "<span class='error'>Brand field must not be empty!</span>";
			return $msg;
		}
		else{
			$query = "INSERT INTO tbl_brand(brandName) VALUES('$brandName')";
			$brandinsert = $this->db->insert($query);
			if ($brandinsert) {
				$msg = "<span class='success'>Brand name inserted successfully.</span>";
				return $msg;
			}
			else{
				$msg = "<span class='error'>Brand name didn't insert.</span>";
				return $msg;
			}
		}
	}
	public function getallbrand(){
		$query =  "SELECT * FROM tbl_brand ORDER BY brandId ASC";
		$result = $this->db->select($query);
		return $result;
	}
	public function getbrandbyid($id){
		$query =  "SELECT * FROM tbl_brand WHERE brandId = '$id'";
		$result = $this->db->select($query);
		return $result;
	}
	public function brandupdate($brandName, $id){
		$brandName = $this->fm->validation($brandName);
		$brandName = mysqli_real_escape_string($this->db->link,$brandName);
		$id = mysqli_real_escape_string($this->db->link,$id);
		if (empty($brandName)) {
			$msg = "<span class='error'>Brand field must not be empty!</span>";
			return $msg;
		}
		else{
		$query =  "UPDATE tbl_brand SET brandName = '$brandName' WHERE brandId = '$id'";
		$updated_row = $this->db->update($query);
		if ($updated_row) {
			$msg = "<span class='success'>Brand updated successfully.</span>";
				return $msg;
		}
		else{
				$msg = "<span class='error'>Brand didn't update.</span>";
				return $msg;
			}
		}
	}
	public function delbrandbyid($id){
		$query =  "DELETE FROM tbl_brand WHERE brandId = '$id'";
		$deldata = $this->db->delete($query);
		if ($deldata) {
			$msg = "<span class='success'>Brand deleted successfully.</span>";
				return $msg;
		}
		else{
			$msg = "<span class='error'>Brand didn't delete.</span>";
				return $msg;
		}
	}
}
?>