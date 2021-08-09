<div class="card__wrapper-inner col s6">
    <div class="card">
        <div class="card-image waves-effect waves-block waves-light">
            <img class="activator card-image" src="<?= "/uploads/image/$type/$announcement[name_photo]"; ?>"
                 style="min-height: 350px; max-height: 750px; background-size: cover; background-position: center; object-fit: cover;">
        </div>
        <div class="card-content">
      <span class="card-title activator grey-text text-darken-4">
          <?php if ($type === 'sale') {
              echo 'Продажа';
          } else {
              echo 'Аренда';
          }
          ?>
        <i class="material-icons right">more_vert</i>
      </span>
            <h5><?php echo 'Цена: ' . $announcement['price'] . ' BYN'; ?> </h5>
            <p><?php echo 'Минск, ' . $announcement['street']; ?></p>
            <?php if ($type === 'sale') {
                echo "<span>$announcement[rooms_count]</span>";
            } else {
                echo "<span>$announcement[type_of_rent]</span>";
            }
            ?>
            <span><?php echo $announcement['living_area'] . 'м2'; ?></span>
            <span><?php echo $announcement['floor'] . '/' . $announcement['count_floor'] . 'этаж'; ?></span>
        </div>

        <div class="card-action">
            <a href="/announcement/<?=$type?>/<?=$announcement['id']?>" target="_blank">Перейти к объявлению</a>
            <?php if (isset($profile)) : ?>
                <a href="/announcement/<?=$type?>/delete/<?=$announcement['id']?>">Удалить</a>
            <?php endif; ?>
        </div>

        <div class="card-reveal">
            <span class="card-title grey-text text-darken-4">Описание<i class="material-icons right">close</i></span>
            <p><?php echo $announcement['description'] ?> </p>
        </div>
    </div>
</div>