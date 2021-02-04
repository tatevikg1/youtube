<aside class="shadow">

    <?php

    use yii\bootstrap4\Nav;

    echo Nav::widget([
        'options' => [
            'class' => 'd-flex flex-column nav-pills'
        ],
        'items' => [
            ['label' => 'Dashboard',    'url' => ['/site/index']],
            ['label' => 'Videos',       'url' => ['/video/index']],
            ['label' => 'Playlists',    'url' => ['/playlist/index']],
            ['label' => 'Comments',     'url' => ['/comment/index']],
            ['label' => 'Profile',      'url' => ['/profile/update']],
        ]
    ])?>


</aside>
