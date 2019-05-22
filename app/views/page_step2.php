<div class="container">
  <form method="POST">
    <ul class="flex-outer">
      <li>
          <?= $this->error?>
      </li>
      <li>
        <label for="street">Street</label>
        <input type="text" id="street" name="street" value="<?=$_SESSION['street']?>" required>
      </li>
      <li>
        <label for="house">House №</label>
        <input type="text" id="house" name="house" value="<?=$_SESSION['house']?>" required>
      </li>
      <li>
        <label for="city">City</label>
        <input type="text" id="city" name="city" value="<?=$_SESSION['city']?>" required>
      </li>
      <li>
        <input type="hidden" name="action" value="data">
        <input type="submit" value="nextly">
      </li>
    </ul>
  </form>
</div>

<div class="container">
  <form method="POST" action="index">
    <ul class="flex-outer">
      <li>
        <input type="hidden" name="action" value="back">
        <input type="submit" value="back">
      </li>
    </ul>
  </form>
</div>