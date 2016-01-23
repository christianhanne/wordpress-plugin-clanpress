<ul class="top_match">
  <?php foreach ($links as $link): ?>
    <li class="top_match__item top_match__item--<?php echo $link['id']; ?>">
      <a href="<?php echo $link['href']; ?>"><?php echo $link['title']; ?></a>
    </li>
  <?php endforeach; ?>
</ul>
