<?php  
	class Blog extends Database{

		function __construct(){
			Database::__construct();
			$this->table = 'blogs';
		}
		public function addBlog($data, $is_die = false){
			return $this->addData($data);
		}
		public function getAllBlog($is_die = false){
			$args = array(
				'fields' => array(
					'id',
					'title',
					'content',
					'featured',
					'categoryid',
					'(SELECT categoryname from categories where id = categoryid) as category',
					'view',
					'image',
				),
				'where' => array(
					'or' => array(
						'status' => 'Active',
					)
				)
			);
			return $this->getData($args, $is_die);
		}
		public function getBlogbyId($blogid, $is_die = false){
			$args = array(
				'fields' => array(
					'id',
					'title',
					'content',
					'featured',
					'categoryid',
					'(SELECT categoryname from categories where id = categoryid) as category',
					'view',
					'image',
					'created_date',
				),
				'where' => array(
					'and' => array(
						'id' => $blogid,
					)
				)
			);
			return $this->getData($args, $is_die);
		}
		public function getBlogbyDate($date,$is_die=false){
			$args = array(
				'fields' => array(
					'id',
		            'title',
		            'content',
		            'featured',
		            'categoryid',
		            '(SELECT categoryname from categories where id = categoryid) as category',
		            'view',
		            'image',
		        	'created_date',
		        ),
				'where' => " where created_date LIKE '".$date."%'"
			);
			return $this->getData($args,$is_die);
		}
		public function getAllFeaturedBlogByCategoryWithLimit($cat_id,$offset,$no_of_data,$is_die=false){
			$args = array(
				'fields' => array(
					'id',
		            'title',
		            'content',
		            'featured',
		            'categoryid',
		            '(SELECT categoryname from categories where id = categoryid) as category',
		            'view',
		            'image',
		        	'created_date',
		        ),
				'where' => array(
						'and' => array(
							'status'=>'Active',
							'featured' =>"Featured",
							'categoryid'=>$cat_id,
						)
					),
				'limit' => array(
							'offset' => $offset,
							'no_of_data' => $no_of_data,
				 		)
			);
			return $this->getData($args,$is_die);
		}
		public function getAllFeaturedBlogWithLimit($offset,$no_of_data,$is_die=false){
			$args = array(
				'fields' => array(
					'id',
		            'title',
		            'content',
		            'featured',
		            'categoryid',
		            '(SELECT categoryname from categories where id = categoryid) as category',
		            'view',
		            'image',
		        	'created_date',
		        ),
				'where' => array(
						'and' => array(
							'status'=>'Active',
							'featured' =>"Featured",
						)
					),
				'limit' => array(
							'offset' => $offset,
							'no_of_data' => $no_of_data,
				 		)
			);
			return $this->getData($args,$is_die);
		}
		public function getAllRecentBlogByCategoryWithLimit($cat_id,$offset,$no_of_data,$is_die=false){
			$args = array(
				'fields' => array(
					'id',
		            'title',
		            'content',
		            'featured',
		            'categoryid',
		            '(SELECT categoryname from categories where id = categoryid) as category',
		            'view',
		            'image',
		        	'created_date',
		        ),
				'where' => array(
						'and' => array(
							'status'=>'Active',
							'categoryid'=>$cat_id
						)
					),
				'limit' => array(
							'offset' => $offset,
							'no_of_data' => $no_of_data	
				 		)
			);
			return $this->getData($args,$is_die);
		}
		public function getAllRecentBlogWithLimit($offset,$no_of_data,$is_die=false){
			$args = array(
				'fields' => array(
					'id',
		            'title',
		            'content',
		            'featured',
		            'categoryid',
		            '(SELECT categoryname from categories where id = categoryid) as category',
		            'view',
		            'image',
		        	'created_date',
		        ),
				'where' => array(
						'and' => array(
							'status'=>'Active',
						)
					),
				'limit' => array(
							'offset' => $offset,
							'no_of_data' => $no_of_data	
				 		)
			);
			return $this->getData($args,$is_die);
		}
		public function getNumberBlogByCategory($cat_id,$is_die=false){
			$args = array(
				'fields' => ['COUNT(id) as total'],
				'where' => array(
						'and' => array(
							'status'=>'Active',
							'categoryid'=>$cat_id
						)
					)
			);
			return $this->getData($args,$is_die);
		}
		public function getAllPopularBlogByCategoryWithLimit($cat_id,$offset,$no_of_data,$is_die=false){
			$args = array(
				'fields' => array(
					'id',
		            'title',
		            'content',
		            'featured',
		            'categoryid',
		            '(SELECT categoryname from categories where id = categoryid) as category',
		            'view',
		            'image',
		        	'created_date',
		        ),
				'where' => array(
						'and' => array(
							'status'=>'Active',
							'categoryid'=>$cat_id
						)
					),
				'order' =>array(
						'columnname'=>'view',
						'orderType'=>'DESC'
					),
				'limit' => array(
							'offset' => $offset,
							'no_of_data' => $no_of_data	
				 		)
			);
			return $this->getData($args,$is_die);
		}
		public function getAllPopularBlogWithLimit($offset,$no_of_data,$is_die=false){
			$args = array(
				'fields' => array(
					'id',
		            'title',
		            'content',
		            'featured',
		            'categoryid',
		            '(SELECT categoryname from categories where id = categoryid) as category',
		            'view',
		            'image',
		        	'created_date',
		        ),
				'where' => array(
						'and' => array(
							'status'=>'Active',
						)
					),
				'order' =>array(
						'columnname'=>'view',
						'orderType'=>'DESC'
					),
				'limit' => array(
							'offset' => $offset,
							'no_of_data' => $no_of_data	
				 		)
			);
			return $this->getData($args,$is_die);
		}
		public function getBlogbySearch($search, $searchin, $offset, $no_of_data, $is_die=false){
			
			$args = array(
				'fields'=>	['id',
				            'title',
				            'content',
				            'featured',
				            'categoryid',
				            '(SELECT categoryname from categories where id = categoryid) as category',
				            'view',
				            'image',
				            'added_by',
				        	'created_date'],
				'where' => " where ".$searchin." LIKE '%".$search."%'",
				'order' => 'DESC',
				'limit' => array(
								'offset' => $offset,				//take data leaving some no.
								'no_of_data' => $no_of_data
								)
				);

			return $this->getData($args,$is_die);
		}
		public function getBlogbySearchWithSearchinArray($search, $searchin1, $searchin2, $offset, $no_of_data, $is_die=false){
			
			$args = array(
				'fields'=>	['id',
				            'title',
				            'content',
				            'featured',
				            'categoryid',
				            '(SELECT categoryname from categories where id = categoryid) as category',
				            'view',
				            'image',
				            'added_by',
				        	'created_date'],
				'where' => array(
							'or' => array(
									" where ".$searchin1." LIKE '%".$search."%'",
									" where ".$searchin2." LIKE '%".$search."%'",	
								)	
						),
				'order' => 'DESC',
				'limit' => array(
								'offset' => $offset,				//take data leaving some no.
								'no_of_data' => $no_of_data
								)
				);

			return $this->getData($args,$is_die);
		}
		public function updateBlogById($data,$id,$is_die=false){
			$args = array(
				'where' => array(
						'or' => array(
							'id' => $id,
						)
					)
			);
			return $this->updateData($data,$args,$is_die);
		}

		public function deleteBlogById($id,$is_die=false){
			$args = array(
				'where' => array(
						'or' => array(
							'id' => $id,
						)
					)
			);
			return $this->deleteData($args,$is_die);
		}
	}
?>