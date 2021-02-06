<aside class="shadow">

    <?php

    use yii\bootstrap4\Nav;

    echo Nav::widget([
        'options' => [
            'class' => 'd-flex flex-column nav-pills'
        ],
        'encodeLabels' => false,
        'items' => [
            ['label' => '<i class="fas fa-home"></i> Home',                     'url' => ['/video/index']],
            ['label' => '<i class="fas fa-fire"></i> Tranding',                 'url' => ['/feed/tranding']],
            ['label' => '<img width="15px" src="/subs.svg"/> Subscriptions',    'url' => ['/feed/subscribtion']],
            
            ['label' => '<hr class="m-0 p-0">'],
            
            ['label' => '<img width="15px" src="/library.svg" /> Library',      'url' => ['/feed/library']],
            ['label' => '<i class="fa fa-history"></i> History',                'url' => ['/feed/history']],
            ['label' => '<i class="fas fa-clock"></i> Watch later',             'url' => ['/feed/later']],
            ['label' => '<i class="fas fa-thumbs-up"></i> Liked videos',        'url' => ['/feed/liked']],
            ['label' => '<i class="fas fa-comments"></i> Comments',             'url' => ['/comment/index']],
            ['label' => '<i class="fas fa-question-circle"></i> Help',          'url' => ['/site/contact']],
        ]
    ])?>


</aside>
