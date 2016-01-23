<ul class="latest_matches">
  <?php foreach ($links as $link): ?>
    <li class="latest_matches__item latest_matches__item--<?php echo $link['id']; ?>">
      <a href="<?php echo $link['href']; ?>"><?php echo $link['title']; ?></a>
    </li>
  <?php endforeach; ?>
</ul>
