<aside class="shadow">

    <?php

    use yii\bootstrap4\Nav;

    echo Nav::widget([
        'options' => [
            'class' => 'd-flex flex-column nav-pills'
        ],
        'encodeLabels' => false,
        'items' => [
            ['label' => '<i class="fas fa-chart-line"></i> Dashboard',    'url' => ['/site/index']],
            ['label' => '<i class="fas fa-film"></i> Videos',       'url' => ['/video/index']],
            ['label' => '<i class="far fa-comments"></i> Comments',     'url' => ['/comment/index']],
            ['label' => '<i class="far fa-user"></i> Profile',      'url' => ['/profile/update']],
        ]
    ])?>


</aside>
