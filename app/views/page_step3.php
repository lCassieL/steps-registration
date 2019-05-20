<div class="container">
  <form method="POST">
    <ul class="flex-outer">
      <li>
        <label for="comment">Comment</label>
        <textarea id="city" name="comment"><?=$_SESSION['comment']?></textarea>
      </li>
      <li>
        <input type="hidden" name="action" value="data">
        <input type="submit" value="finish">
      </li>
    </ul>
  </form>
</div>

<div class="container">
  <form method="POST" action="address">
    <ul class="flex-outer">
      <li>
        <input type="hidden" name="action" value="back">
        <input type="submit" value="back">
      </li>
    </ul>
  </form>
</div>