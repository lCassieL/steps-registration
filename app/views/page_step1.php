<div class="container">
  <form method="POST">
    <ul class="flex-outer">
      <li>
      <?= $this->error?>
      </li>
      <li>
        <label for="first-name">Name</label>
        <input type="text" id="first-name" name="name" value="<?=$_SESSION['name']?>" required>
      </li>
      <li>
        <label for="last-name">Surname</label>
        <input type="text" id="last-name" name="surname" value="<?=$_SESSION['surname']?>" required>
      </li>
      <li>
        <label for="phone">Phone</label>
        <input type="tel" id="phone" name="phone" value="<?=$_SESSION['phone']?>" required>
      </li>
      <li>
      <input type="hidden" name="action" value="data">
      <input type="submit" value="nextly">
      </li>
    </ul>
  </form>
</div>