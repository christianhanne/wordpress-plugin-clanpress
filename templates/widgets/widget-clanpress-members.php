<ul class="members">
  <?php foreach ($members as $member): ?>
    <li class="members__item members__item--<?php echo $member['id']; ?>">
      <?php echo $member['name']; ?>
    </li>
  <?php endforeach; ?>
</ul>
