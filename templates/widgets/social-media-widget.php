<ul class="social_media">
  <?php foreach ($links as $key => $link): ?>
    <li class="social_media__item social_media__item--<?php echo $key; ?>">
      <a href="<?php echo $link['href']; ?>"><?php echo $link['title']; ?></a>
    </li>
  <?php endforeach; ?>
</ul>
