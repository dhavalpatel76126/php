<?php
error_reporting(E_ALL & ~E_NOTICE);
$servername = "localhost";
$username = "root";
$password = "";
$database = "cricket";
$conn = mysqli_connect($servername, $username, $password, $database);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

echo "Connesssted successfully<br>";

echo "<pre>";
print_r($_GET);
echo "</pre></br>";

$mem = $_GET['member'];

$per = $_GET['percentage'];

$id = $_GET['id'];
$delete = $_GET['delete'];




for ($i = 0; $i < count($id); $i++) {
    //  echo "column count".$i."<br>";
    if ($id[$i]) {
        $sql = "UPDATE member SET mem = '{$mem[$i]}', per = '{$per[$i]}' WHERE id = {$id[$i]}";

    } else {
        $sql = "INSERT INTO member (mem,per) VALUES ('{$mem[$i]}', '{$per[$i]}')";

    }
    
    echo $sql . "<br>";
    if (mysqli_query($conn, $sql)) {

    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    $deleteData = "DELETE FROM member WHERE id IN ({$delete[$i]})";
    mysqli_query($conn,$deleteData);
  
}

echo "New records created successfully<br>";

?>
<!DOCTYPE html>
<html>

<body>
    <br/>
    <div id="clone">
        id:-<input type="text" name="id[]" style="width: 100px" value="0" readonly/>
        Member:-<input type="text" name="member[]" style="width: 100px " value="s" required />
        Percentage:-<input type="text" name="percentage[]" style="width: 100px " required />
    </div>
    <br />
    <form name="myForm" action="index.php">


   <input type="text" placeholder="Deleted ids" id="deleted" name=delete[]>
    <div id="divmain">
        <?php
$selectData = "SELECT * FROM member";
$result = mysqli_query($conn, $selectData);

if (mysqli_num_rows($result) > 0) {

    while ($row = mysqli_fetch_assoc($result)) {$idData = $row['id'];?>
            <table><tr><td>
        id:-<input type="text" name="id[]" style="width: 100px " value="<?php echo $row['id']; ?>" readonly />
        </td><td>Member :- <input type='text' name='member[]' style='width: 100px' value="<?php echo $row['mem']; ?>" required /><br>
            </td><td> Percentage:-<input type='text' name='percentage[]' style='width: 100px' value="<?php echo $row['per']; ?>" required />
            </td>
         <td> <input type="button" onclick="selectId(this)" id="arr" name="bulk_delete_submit[]" value="<?php echo $row['id']; ?>"/></td>
        </tr> </table>
          <?php }
} else {
    echo "0 results";
}

mysqli_close($conn);
?>
        </div>

        <br>From here we will add Clones<br>

        <br/><br>

            <input type="submit" name="save" style="width:100px;height:100px">

    </form>
    <br>
    <button onclick="clone()" style="width:75px;height:30px">+</button>
    <script>
            var x = 0;
            var array = Array();
            function selectId(abc){
                array.push(abc.value);
                var input=document.getElementById("deleted");
                input.value=array.join(",");
            }

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
