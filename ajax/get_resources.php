<?php
	require_once(__DIR__ . '/../../includes/db_functions.php');
	
	$ALL = -1;
	$NONE = 0;
	
	/** GET VALUES **/

	if(isset($_GET['cat']))
	{
		if($_GET['cat'] == 'all') 
			$cat = $ALL; 
		else 
			$cat = intval($_GET['cat']);
	}
	else
	{
		$cat = $NONE;
	}
	
	if(isset($_GET['sub'])) 
	{
		if($_GET['sub'] == 'all') 
			$sub = $ALL; 
		else 
			$sub = intval($_GET['sub']);
	}
	else
	{
		$sub = $NONE;
	}
	
	if(isset($_GET['typ']))
	{
		if($_GET['typ'] == 'all') 
			$typ = $ALL; 
		else 
			$typ = intval($_GET['typ']);
	}
	else
	{
		$typ = $NONE;
	}
	
	/** GET RESOURCES **/
	
	if($cat != $NONE)
	{
		try {
			if($cat == $ALL)
			{
				if($sub == $NONE)
				{
					if ($typ == $ALL)
					{
						// Load ALL Categories and ALL Types
						$handle = $link->prepare('SELECT * FROM Resources');
					}
					else if ($typ != $NONE)
					{
						// Load ALL Categories with specific Types
						$handle = $link->prepare('SELECT * FROM Resources WHERE TypeID = ?');
						$handle->bindValue(1, $typ, PDO::PARAM_INT);
					}
				}
			}
			else
			{
				// cat has value
				if($sub == $ALL)
				{
					if($typ == $ALL)
					{
						$handle = $link->prepare('SELECT * FROM Resources WHERE CategoryID = ?');
						$handle->bindValue(1, $cat, PDO::PARAM_INT);
					}
					else if($typ != $NONE)
					{
						$handle = $link->prepare('SELECT * FROM Resources WHERE CategoryID = ? AND TypeID = ?');
						$handle->bindValue(1, $cat, PDO::PARAM_INT);
						$handle->bindValue(2, $typ, PDO::PARAM_INT);
					}
				}
				else if ($sub != $NONE)
				{
					// sub has value
					if ($typ == $ALL)
					{
						$handle = $link->prepare('SELECT * FROM Resources WHERE CategoryID = ? AND SubcategoryID = ?');
						$handle->bindValue(1, $cat, PDO::PARAM_INT);
						$handle->bindValue(2, $sub, PDO::PARAM_INT);
					}
					else if($typ != $NONE)
					{
						$handle = $link->prepare('SELECT * FROM Resources WHERE CategoryID = ? AND SubcategoryID = ? AND TypeID = ?');
						$handle->bindValue(1, $cat, PDO::PARAM_INT);
						$handle->bindValue(2, $sub, PDO::PARAM_INT);
						$handle->bindValue(3, $typ, PDO::PARAM_INT);
					}
				}
			}
			
			if(isset($handle))
			{
				$handle->execute();
				$results = $handle->fetchAll();
				
				foreach($results as $key => $resource) 
				{
					$rating = getResourceRatings($resource['ID']);
					$results[$key]['Rating'] = $rating['Rating'];
					$results[$key]['RatingCount'] = $rating['Count'];
				}
				
				echo json_encode($results);
			}
		} catch(PDOException $e) {
			print($e->getMessage());
		}
	}
?>