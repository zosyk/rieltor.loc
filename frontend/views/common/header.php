<?
use yii\bootstrap\Nav;
?>
<!-- Header Starts -->
<div class="navbar-wrapper">

    <div class="navbar-inverse" role="navigation">
        <div class="container">
            <div class="navbar-header">


                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

            </div>


            <!-- Nav Starts -->
            <div class="navbar-collapse  collapse">
                <?
                $menuItems = [
                    ['label' => 'Home', 'url' => '/'],
                    ['label' => 'About', 'url' => ['/main/main/page', 'view' => 'about']],
                    ['label' => 'Contact', 'url' => ['/main/main/page', 'view' => 'contact']],
                ];
                echo Nav::widget([
                    'options' => ['class' => 'navbar-nav navbar-right'],
                    'items' => $menuItems,
                ]);
                ?>
            </div>
            <!-- #Nav Ends -->

        </div>
    </div>

</div>
<!-- #Header Starts -->





<div class="container">

    <!-- Header Starts -->
    <div class="header">
        <a href="/" ><img src="/images/logo.png"  alt="Realestate"></a>
        <?
        $menuItems = [];
        $guest = Yii::$app->user->isGuest;
        if($guest) {
            $menuItems[] =  ['label' => 'Login', 'url' => '#', 'linkOptions' => ['data-target' => '#loginpop', 'data-toggle' => "modal"]];
        }
        else{
            $menuItems[] =  ['label' => 'Manager adverts', 'url' => ['/cabinet/advert']];
            $menuItems[] =  ['label' => 'Settings', 'url' => ['/cabinet/default/settings']];
            $menuItems[] =  ['label' => 'Change Password', 'url' => ['/cabinet/default/change-password']];
            $menuItems[] = ['label' => 'Logout',  'url' => ['/site/logout'], 'linkOptions' => ['data-method' => 'post']];
        }
        echo Nav::widget([
            'options' => ['class' => 'pull-right'],
            'items' => $menuItems,
        ]);
        ?>
    </div>
    <!-- #Header Starts -->
</div>