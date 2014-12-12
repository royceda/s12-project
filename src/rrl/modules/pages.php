<?php
if ($pages!=1 && $pages!=0){?>
<span class="navigation_p">Page :

<?	if ($page<2){
		$start=0;
		if ($pages<5 && $pages!=0)
			$end=$pages;
		else if($pages<5 && $pages==0)
			$end=$pages;
		else
			$end=5;
	}
	else{
		if ($pages<6){
			$start=0;
				$end=$pages;
		}
		else if($page+2>=$pages){
			$start=$pages-4;
			$end=$pages;
		}	

		else{
			$start=$page-2;
			if ($pages<$page+3)
				$end=$pages;
			else $end=$page+3;
		}
	}

	if ($pages>5 && $page>3){
		?> <a href="?p=<?php echo $start-1?>">&lt;</a>
	<?php }
	for ($i=$start;$i<$end;$i++){
		if ($i==$page){?>
			<span class="actuel"><?php echo $page?></span>
		
		<?php
		} 
		else {?>
			<a href="?p=<?php echo $i?><?php if ($c=true) echo '&amp;id='.$id?>"><?php echo $i?></a> 		 
	<?php 	}
	}
	if ($pages>$end+2){?>	
	 <a href="?p='<?php echo ($end+2)?><?php if ($c=true) echo '&amp;id='.$id?>'">...</a>'
	<?php }if ($pages!=$page && $end!=$pages){?> 
		<a href="?p=<?php echo ($page+1)?><?php if ($c=true) echo '&amp;id='.$id?>">&gt;</a>
	<?php
	}?>
	</span>
	<?php }?>