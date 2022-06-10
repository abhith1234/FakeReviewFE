<?php echo $_POST['bal'] ?>

<?php 
$j=$_POST['bal'];
?>
<script>
var review = "<?php echo $j; ?>";
//Do something
</script>
<?php
echo $j;
?>

<script>
        const xhr = new XMLHttpRequest();
        var file = localStorage.getItem("file");
        var review = "<?php  Print($j); ?>";
        console.log("review : ", review);
    xhr.open("GET", "http://127.0.0.1:5000/?review=" + review , true);
    xhr.getResponseHeader("Content-type", "application/json");
  
    xhr.onload = function() {
        const obj = JSON.parse(this.responseText);
        console.log(obj);
        location.href = 'http://localhost/fakereview//manage-users.php';
    }

    xhr.send();

      </script>


<?php
// header( "Location: manage-users.php");
exit ;
?>
