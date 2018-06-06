<<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<form>
<label for="pword">Password:</label>
<span>
    <input type="password" id="pword" name="pword" />
    <input type="text" id="pword" autocomplete="off" style="display:none;" />
    <label class="show-password" for="showpasscheckbox-1" title="Show the password as plain text">
        <input type="checkbox" id="showpasscheckbox-1" title="Show the password as plain text" />
        <span>Show Password</span>
    </label>
</span>
</form>
</body>
</html>


<!-- <?PHP
if (isset($_POST['submit']))
{
$how_many = $_POST['how_many'];
echo "<form action = '' method = 'post' role='form'>";
for ($i=0; $i<$how_many; $i++)
{

    echo "
<div class='form-group'>
<label> $i Due Date </label>
<input class='form-control' type='number' name='text_$i' id=text_$i required />
</div>
    ";


}
echo '<input type="submit" class="btn btn-info" value="Submit" name="submit">';
}
?> -->
