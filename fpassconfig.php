<?php
$conn = mysqli_connect("localhost:3303","","","");

if(mysqli_connect_errno()){
    echo'<script>Failed to Connect to database</script>' . mysqli_connect_errno();
}
?>
