<html>
<head>
<title>Twitter Contest Dashboard</title>
<?= link_tag('assets/stylesheets/foundation.css');?>
<?= link_tag('assets/stylesheets/style.css');?>
</head>
<body>	
	  <table>
  	 <caption>Submitted Images</caption>
  	 <thead>
  	   <tr>
  	     <th>id</th>
  	     <th>Filename</th>
  	     <th>Url</th>
  	     <th>Spam Count</th>
  	     <th>Approve</th>
  	     <th>Thumbnail</th>
  	     <th>Actions</th>
  	   </tr>
  	 </thead>
  	 <tbody>
  	   <?php foreach($pics as $pic){ ?>
    	   <tr>
  	       <td><?= $pic['id']; ?></td>
    	     <td><?= $pic['filename'];?></td>
    	     <td><?= $pic["url"];?></td>
    	     <td><?= $pic["spamcount"];?></td>
    	     <td><?php if($pic["favorite"] == true){echo "Yes";};?></td>
    	     <td><img src="../uploads/<?= $pic['filename'];?>"></td>
           <td><a href="admin/favorite/<?=$pic['filename']?>"><img src="../assets/images/ic_ok.png" alt="approve" /></a> &nbsp;<a href="admin/mark_spam/<?=$pic['filename']?>"><img src="../assets/images/ic_minus.png" alt="mark as spam"></a> <a href="admin/delete/<?=$pic['filename']?>"><img src="../assets/images/ic_delete.png" alt="delete"></a></td>
    	   </tr>
	     <?php } ?>	
  	 </tbody>
  	</table>
  
</body>
</html>