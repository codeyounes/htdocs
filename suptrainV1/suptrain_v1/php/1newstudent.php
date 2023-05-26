<?php
if(isset($_SESSION['insNewMsg'])) echo $_SESSION['insNewMsg'];
$_SESSION['insNewMsg']='';
?>
<h3> Add new student</h3>
<form action="php/1insertstudent.php" method="post">
<div class="form-group">
    <label for="studentID">StudentID</label>
    <input type="text" name="studentID" class="form-control" autofocus required />
  </div>
  <div class="form-group">
    <label for="firstname">First Name</label>
    <input type="text" name="firstname" class="form-control" autofocus required />
  </div>
  <div class="form-group">
    <label for="lastname">Last Name</label>
    <input type="text" name="lastname" class="form-control" autofocus required />
  </div>
  <div class="form-group">
    <label for="email">Email</label>
    <input type="text" name="email" class="form-control" autofocus required />
  </div>
  <div class="form-group">
    <label for="phone">Phone</label>
    <input type="text" name="phone" class="form-control" autofocus required />
  </div>
  <div class="form-group">
    <label for="practicaltrainingdone">Practicaltrainingdone</label>
    <input type="number" name="practicaltrainingdone" class="form-control" autofocus required />
  </div>
  <div class="form-group">
    <label for="groupname">Group name</label>
    <input type="text" name="groupname" class="form-control" autofocus required />
  </div>
  <button class="btn btn-lg btn-primary btn-block" type="submit">Insert</button>
</form>
