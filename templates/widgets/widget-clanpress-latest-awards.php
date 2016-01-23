<ul class="latest_awards">
  <?php foreach ($links as $link): ?>
    <li class="latest_awards__item latest_awards__item--<?php echo $link['id']; ?>">
      <a href="<?php echo $link['href']; ?>"><?php echo $link['title']; ?></a>
    </li>
  <?php endforeach; ?>
</ul>
