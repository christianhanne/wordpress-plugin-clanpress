<ul class="sponsors">
  <?php foreach ($links as $link): ?>
    <li class="sponsors__item sponsors__item--<?php echo $link['id']; ?>">
      <a href="<?php echo $link['href']; ?>"><?php echo $link['title']; ?></a>
    </li>
  <?php endforeach; ?>
</ul>
