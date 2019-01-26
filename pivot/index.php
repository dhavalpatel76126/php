<?php
// Define needed credentials.
$servername = "localhost";
$username = "root";
$password = "";
$database = "todo";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);
$sql = "SELECT * FROM category ";
$result = mysqli_query($conn, $sql);

?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>jQuery UI Sortable - Connect lists</title>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <style>
  #sortable1, #sortable2 {
    border: 1px solid #eee;
    width: 142px;
    min-height: 20px;
    list-style-type: none;
    margin: 0;
    padding: 5px 0 0 0;
    float: left;
    margin-right: 10px;
  }

  #sortable1 li, #sortable2 li {
    margin: 0 5px 5px 5px;
    padding: 5px;
    font-size: 1.2em;
    width: 120px;
  }
  img{
      width: 100px;
      height:100px;
  }
  img:hover{
     border: solid;
  }
  </style>
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
$( function() {

    $( "#sortable1, #sortable2" ).sortable({

connectWith: ".connectedSortable"

}).disableSelection();

    $( "#sortable2" ).droppable({

      drop: function( event, ui ) {

     $(this).addClass( "ui-state-highlight" );

     var itemid = ui.draggable.attr('id')
     var categoryvalue=$("#category").val();

    
     $.ajax({
        method: "POST",
        url: "update.php",
        data:{'itemid': itemid,'categoryid':categoryvalue},
     })
  
    }
});

$( "#sortable1" ).droppable({

  drop: function( event, ui ) {

  $(this).addClass( "ui-state-highlight" );

  var itemid = ui.draggable.attr('id')
 alert(itemid);
  $.ajax({
     method: "POST",
     url: "update2.php",
     data:{'itemid2': itemid},
  })
 }
});
} );
  </script>
</head>
<body>
<form method="get" action="">
<select name="" onchange="myFunction(this.value);"  id="category">
<option value="0">Select Category</option>
<?php
$sql = "SELECT * FROM category";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {

    while ($row = mysqli_fetch_assoc($result)) {

        $id = $row['id'];

        echo "<option value='$id' >" . $row['name'] . "</option>";
    }
} else {
    echo "0 results";
}

?>
</select>
</form>
<br>
<ul id="sortable1" class="connectedSortable">

</ul>

<ul id="sortable2" class="connectedSortable">

    <!-- <?php/*
  if(isset($_POST['y'])){
$sql2 = "SELECT product.id,product.name FROM product  INNER JOIN pivot on pivot.product_id=product.id";
$result2 = mysqli_query($conn, $sql2);
while ($row2 = mysqli_fetch_assoc($result2)) {
    ?>
  <li class="ui-state-highlight" id="<?=$row2['id']?>"><?=$row2['name']?></li>

    <?php }}*/?> -->
</ul>
<script>
  function myFunction(val) {
    $('#sortable1').children('li').remove();
	$.ajax({
	type: "GET",
	url: "select.php",
	data:'x='+val,
	success: function(data){
					var region = jQuery.parseJSON(data);
          for (var i = 0; i < region.length; i++) {
						$('#sortable1').append('<li id="' + region[i].id  + '">' + region[i].name + '</li>');

					}

	}
  });
  $('#sortable2').children('li').remove();
  var categoryvalue=$("#category option:selected").val();
  $.ajax({
	type: "GET",
	url: "index2.php",
	data:{'categoryvalue': categoryvalue},
  success: function(data){
    var region = jQuery.parseJSON(data);
          for (var i = 0; i < region.length; i++) {
						$('#sortable2').append('<li id="' + region[i].id  + '">' + region[i].name + '</li>');

					}

  }
	});
}

  </script>
</body>
</html>