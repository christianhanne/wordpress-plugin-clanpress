<ul class="squads">
  <?php foreach ($links as $link): ?>
    <li class="squads__item squads__item--<?php echo $link['id']; ?>">
      <a href="<?php echo $link['href']; ?>"><?php echo $link['title']; ?></a>
    </li>
  <?php endforeach; ?>
</ul>
