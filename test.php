<html>
<form id="myForm" method="post">
  <!-- Form fields here -->
  <button type="submit" name="save" onclick="setFormAction('save.php')">Save</button>
  <button type="submit" name="delete" onclick="setFormAction('delete.php')">Delete</button>
</form>

<script>
function setFormAction(action) {
  document.getElementById("myForm").action = action;
}
</script>

</html>