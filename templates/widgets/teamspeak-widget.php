<div class="teamspeak_server">
  <?php if ($error): ?>
    <div class="teamspeak_server__error"><?php echo $error; ?></div>
  <?php else: ?>
    <div class="teamspeak_server__name"><?php echo $name; ?></div>
    <div class="teamspeak_server__address"><?php echo $address; ?></div>
    <div class="teamspeak_server__country"><?php echo $country; ?></div>
    <div class="teamspeak_server__users"><?php echo $users . '/' . $slots; ?></div>
    <div class="teamspeak_server__online">
      <?php if ($online): ?>
        <?php echo __( 'Online', 'clanpress' ); ?>
      <?php else: ?>
        <?php echo __( 'Offline', 'clanpress' ); ?>
      <?php endif; ?>
    </div>
  <?php endif; ?>
</div>
