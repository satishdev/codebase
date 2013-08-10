<?php
class Gallery_model extends CI_Model {
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
	function viewCategories() {
		$this->db->select('id, title, order_id');
		$this->db->from('gallery_categories');
		$this->db->order_by('order_id', 'asc');	
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
	}
	//new
	function viewAlbums($id,$type,$uid) {
		
		//$query = $this->db->query("select * from albums where gallery_type='".$type."' and related_id='".$id."'");
		$query = $this->db->query("select count(ga.img_id) as cnt,al.id,al.name,ifnull(ga.thumbnail,'empty.jpg') as thumbnail,ga.filename,al.created_by as owner  
									from albums al left join gallery_assets ga on al.id=ga.cat_id
								 where al.gallery_type='".$type."' and al.related_id='".$id."' group by al.id");
		$data['total']=$query->num_rows();
		$data['records']=$query->result();
		return $data;
	}
	function viewParticular($catID) {
		$this->db->select('id, title, order_id, description');
		$this->db->from('gallery_categories');
		$this->db->where('id', $catID);	
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
	}
	//new
	function viewParticularGallery($galID,$uid) {
		
		$query = $this->db->query("select * from albums where id='".$galID."'");
		if ($query->num_rows() > 0) {
			
			return $query->row();
		}
		else
		return '';
	}
	//new
	function checkGalleryName($galID,$name) {
		
		$query = $this->db->query("select id from albums where name='".$name."' and  id!='".$galID."'");
		if ($query->num_rows() > 0) {
			
			return 1;
		}
		else
		return 0;
	}
	function insertCategory() {
		if (isset($_POST['title'])) {
			$this->title = $_POST['title'];
			$this->order_id = $_POST['order_id'];
			$this->description = $_POST['description'];
			$insertNew = $this->db->insert('gallery_categories', $this);
			if ($insertNew) {
				redirect('gallery');
			} else {
				echo("Fail");
			}
		}
	}
	//new
	function insertGallery() {
		
			//$check= $this->db->query("select id from albums where name='".$_POST['name']."'");
			//if($check->num_rows()==0){
				$id=$this->my_db_lib->save_record($_POST,'albums');
			/*}else{
				$id=0;
			}*/
			//print_r($_POST);exit;
			if(isset($_POST['src_name']) && is_array($_POST['src_name']))
			 {
				$this->insertImagesOfAlbums($id,$_POST['src_name'],$_POST['created_by']);
			 }
		return $id;
	}
	function checkalbum_name($name,$uid,$id=0,$type=1) {
		
				$qry="SELECT id from albums where name='".$this->db->escape_str($name)."' and related_id='".$uid."' and gallery_type='".$type."'";
			if($id!=0)
			$qry.=" AND id!='".$id."'";
			$sql=$this->db->query($qry);

	    return $sql->num_rows();
	}
	
	function insertImagesOfAlbums($catId, $filename,$user_id) {
		$sql='';
		foreach($filename as $filename_name){
			$sql.="('".$user_id."','".$catId."','1','".addslashes($filename_name)."','".addslashes("th_".$filename_name)."',''),";
		}
		if($sql!=''){
			$this->db->query("insert into gallery_assets (user_id,cat_id,order_num,filename,thumbnail,caption) values ".trim($sql,','));
		}
	}
	function updateCategory() {
		if (isset($_POST['title'])) {
			$this->title = $_POST['title'];
			$this->order_id = $_POST['order_id'];
			$this->description = $_POST['description'];
			$insertNew = $this->db->update('gallery_categories', $this, array('id' => $_POST['id']));
			if ($insertNew) {
				redirect('gallery');
			} else {
				echo("Fail");
			}
		}
	}
	function deleteAlbum($id) {
		if (isset($id)) {
			$this->db->where('id', $id);
			$del = $this->db->delete('albums');
			if ($del) {
				$delImages = $this->db->get_where('gallery_assets',array('cat_id'=>$id));
				if ($delImages->num_rows() > 0) {
					foreach ($delImages->result() as $img) {
						unlink('./uploads/'.$img->filename);
						unlink('./uploads/'.$img->thumbnail);
					}
				}
				$delImg = $this->db->delete('gallery_assets' , array('cat_id' => $id));
			} 
		}
	}
	function deleteImage($id) {
		if (isset($id)) {
			
				$delImages = $this->db->get_where('gallery_assets',array('img_id'=>$id));
				if ($delImages->num_rows() > 0) {
					foreach ($delImages->result() as $img) {
						unlink('./uploads/'.$img->filename);
						unlink('./uploads/'.$img->thumbnail);
					}
				}
				$delImg = $this->db->delete('gallery_assets' , array('img_id' => $id));
		}
	}
	function showImages($catID) {
		$this->db->select('*');
		$this->db->from('gallery_assets');
		$this->db->where('cat_id', $catID);
		$this->db->order_by('gallery_assets.order_num', 'ASC');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
	}
	//new
	function showGalImages($catID) {
		$this->db->select('*');
		$this->db->from('gallery_assets');
		$this->db->where('cat_id', $catID);
		$this->db->order_by('gallery_assets.order_num', 'ASC');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
	}
	//new
	function galparticularImage($id) {
				
		$query = $this->db->query("select img_id, filename, thumbnail, order_num, caption, cat_id from gallery_assets where img_id='".$id."'");
		if ($query->num_rows() > 0) {
			 $data=$query ->row();
			return $data;
		}
		else
		return '';
	}
	function particularImage($id) {
		$this->db->select('img_id, filename, thumbnail, order_num, caption, cat_id');
		$this->db->from('gallery_assets');
		$this->db->where('img_id', $id);	
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
	}
	function insertImage($catId, $filename, $thumbname,$user_id) {
		if (isset($_POST['id'])) {
			$this->cat_id = $catId;
			$this->caption = $_POST['caption'];
			$this->order_num = 1;
			$this->filename = $filename;
			$this->thumbnail = $thumbname;
			$this->user_id = $user_id;
			$insertNew = $this->db->insert('gallery_assets', $this);
			if ($insertNew) {
				return 1;
			} else {
				return 0;
			}
		}
	}
	//new
	function updategalImage() {
		if (isset($_POST['img_id'])) {
			$this->caption = $_POST['caption'];
			$this->order_num = $_POST['order_num'];
			$insertNew = $this->db->update('gallery_assets', $this, array('img_id' => $_POST['img_id']));
			if ($insertNew) {
				return 1;
			} else {
				return 0;
			}
		}
	}
	function updateImage() {
		if (isset($_POST['img_id'])) {
			$this->caption = $_POST['caption'];
			$this->order_num = $_POST['order_num'];
			$insertNew = $this->db->update('gallery_assets', $this, array('img_id' => $_POST['img_id']));
			if ($insertNew) {
				redirect('gallery/images/'.$_POST['cat_id']);
			} else {
				echo("Fail");
			}
		}
	}

	function imgToDelete($fileid){
		$query = $this->db->get_where('gallery_assets',array('img_id'=>$fileid));
		$result = $query->result();
		return $result[0]->filename;
	}
	function thumbToDelete($fileid){
		$query = $this->db->get_where('gallery_assets',array('img_id'=>$fileid));
		$result = $query->result();
		return $result[0]->thumbnail;
	}
}