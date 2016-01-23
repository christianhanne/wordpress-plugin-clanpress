<ul class="upcoming_matches">
  <?php foreach ($links as $link): ?>
    <li class="upcoming_matches__item upcoming_matches__item--<?php echo $link['id']; ?>">
      <a href="<?php echo $link['href']; ?>"><?php echo $link['title']; ?></a>
    </li>
  <?php endforeach; ?>
</ul>
