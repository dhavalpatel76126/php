<?php
// Define needed credentials.
$servername = "localhost";
$username = "root";
$password = "";
$database = "user_details";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);
$sql = "SELECT * FROM user";
$rs_result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>

  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <script src="https://code.jquery.com/jquery-3.3.1.js"></script>


  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.css"/>
<link rel="stylesheet" type="text/css" href="https://editor.datatables.net/extensions/Editor/css/editor.dataTables.min.css"/>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

<script type="text/javascript" src="dataTables.editor.js"></script>
<script>
var editor;
	$(document).ready(function() {
        var table = $('#example').DataTable( {
            "processing": true,
            "serverSide": true,
            "rowId": 'id',
            "ajax": {
                "url": "response.php",
                "data": function ( d ) {
                    d.myKey = $('select.status :selected').val();
                }
            },
            columns: [
                { "data": "id" },
                { "data": "name" },
                { "data": "mail" },
                { "data": "contact" },
                { "data": "technology" },
                { "data": "experience" },
                { "data": "status" },
                {
                "data": null,
                "className": "center",
                "defaultContent": '<a href="" class="editor_edit">Edit</a> / <a href="" class="editor_remove">Delete</a>'
            }
            ]
        });

        $("select.status").change(function(){
            var selectedCountry = $(this).children("option:selected").val();
            console.log(selectedCountry);
            table.draw();
        })


 //delete record

 $(document).on('click', '.editor_remove', function(){
   var id = $(this).closest("tr").attr("id");
 alert(id);
 console.log(id);
   if(confirm("Are you sure you want to remove this?"))
   {
    $.ajax({
     url:"delete.php",
     method:"POST",
     data:{id:id},
     success:function(data){
        $('#example').DataTable().destroy();
      }
    });
   }
  });

  //edit record
  editor = new jQuery.fn.dataTable.Editor( {
        "ajax": "staff.php",
        "table": "#example",
        "idSrc": "id",
        "fields": [ {
                "label": "id:",
                "name": "id"
            }, {
                "label": "name:",
                "name": "name"
            }, {
                "label": "mail:",
                "name": "mail"
            }, {
                "label": "contact:",
                "name": "contact"
            }, {
                "label": "technology:",
                "name": "technology"
            }, {
                "label": "experience:",
                "name": "experience",
              
            }, {
                "label": "status:",
                "name": "status"
            }
        ]
    } );

    $('#example').on('click', 'a.editor_edit', function (e) {
        e.preventDefault();
 
        editor.edit( $(this).closest('tr'), {
            title: 'Edit record',
            buttons: 'Update'
        } );
    } );

  
 });
</script>

</head>
<body>
    <br>
<div class="dropdown">
<label for="sel1">Select list:</label>
  <select class="status" id="sel1">
    <option>0</option>
    <option>1</option>
    <option>all</option>
</select>
    <br><br><br><br><br><br>
<table id="example" class="display" style="width:100%">
        <thead>
            <tr>
                <th>id</th>
                <th>name</th>
                <th>Position</th>
                <th>email</th>
                <th>technology</th>
                <th>experience</th>
                <th>status</th>
                <th>edit/delete</th>
            </tr>
        </thead>

    </table>
</body>
</html>
