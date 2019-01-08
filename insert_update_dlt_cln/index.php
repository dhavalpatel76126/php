<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "cricket";

// Create connection

$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

echo "Connesssted successfully<br>";

$mem=$_GET['member'];

$per=$_GET['percentage'];
//prepare sql statement


$items = array();

$size = count($mem);

for($i = 0 ; $i < $size ; $i++){
  $items[$i] = array(
     "mem"     => $mem[$i], 
     "per"    => $per[$i], 
    
  );
}


$values = array();
foreach($items as $item){
  $values[] = "('{$item['mem']}', '{$item['per']}')";
}

$values = implode(", ", $values);

$sql = "
  INSERT INTO member (mem,per) VALUES {$values} ;
" ;
  if (mysqli_multi_query($conn, $sql)) {
        echo "New records created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    

$conn->close();

?>
<!DOCTYPE html>
<html>

<body>
    <form name="myForm" method="GET">
        <br/>
        <div id="clone">
            Member-<input type="text" name="member[]" style="width: 100px " value="s" required />
            Percentage:-<input type="text" name="percentage[]" style="width: 100px " required />
            <span onclick="remove1(this)" style="width:50px;height:50px;">
                &nbsp; &#x274E;
            </span>
        </div>
        <br />

        <div id="divmain"><br>From here we will add Clones<br></div>
        <br /><br>
        
            <input type="submit" name="save" style="width:100px;height:100px">
                
    </form>
    <br>
    <button onclick="clone()" style="width:75px;height:30px">+</button>
    <script>
        myClondedCount = 1;
        function remove1(remo) {
            var counter = remo.id.split("rem")[1];
            console.log("remo" + counter);
            var myRemove = document.getElementById("cln" + counter);
            myRemove.remove();
        }
        function clone() {
            var elmnt = document.getElementById("clone");
            var cln = elmnt.cloneNode(true);
            document.getElementById("divmain").appendChild(cln);
            cln.id = "cln" + myClondedCount;
            console.log(cln.id);
            var member = cln.children[0];
            member.id = "member" + myClondedCount;
            console.log(member);
            var percentage = cln.children[1];
            percentage.id = "per" + myClondedCount;
            console.log(percentage.id);
            var removeButton = cln.children[2];
            removeButton.id = "rem" + myClondedCount;
            console.log(removeButton.id);
            myClondedCount++;
        }
    </script>
</body>

</html>
