<?php
$conn = mysqli_connect("localhost:3303","root","qawedrtgy1357","userinfo");

if(mysqli_connect_errno()){
    echo'<script>Failed to Connect to database</script>' . mysqli_connect_errno();
}
?>