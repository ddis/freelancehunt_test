<ul class="nav">
    <?php foreach ($items as $item):?>
    <li class="nav-item <?= $item['active'] ? "active" : ""?>">
        <a class="nav-link" href="<?=$item['route']?>">
            <i class="nc-icon <?=$item['icon']?>"></i>
            <p><?=$item['name']?></p>
        </a>
    </li>
    <?php endforeach;?>
</ul>