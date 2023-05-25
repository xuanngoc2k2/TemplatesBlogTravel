<?php
$banner = new Banner();
?>
<div id="banner" class="carousel slide" data-ride="carousel">
    <ul class="carousel-indicators">
    <?php
        $resultbanner = $banner->bannerShow();
        $slbanner = $resultbanner->num_rows;
        for ($i = 0; $i < $slbanner; $i++) {
        ?>
        <li data-target="#banner" data-slide-to="<?php echo $i?>" <?php if($i==0) echo 'class="active"'?>></li>
        <?php
            }
        ?>
        <!-- <li data-target="#banner" data-slide-to="1"></li>
        <li data-target="#banner" data-slide-to="2"></li> -->
    </ul>

    <!-- The slideshow -->
    <div class="carousel-inner">
    <?php
        $results = $banner->bannerShow();
        $dem = 0;
        if ($results) {
            while ($result = $results->fetch_assoc()) {
        ?>
        <div class="carousel-item <?php if($dem==0) echo 'active'?>">
            <img src="admin/uploads/<?php echo $result['bannerImage'] ?>" alt="<?php echo $result['bannerTitle'] ?>" width="1100" height="500">
            <div class="content">
                <div class="name"><?php echo $result['bannerTitle'] ?></div>
                <div class="des"><?php echo $result['bannerDetail'] ?></div>
                <button>Read More</button>
            </div>
        </div>
        <?php
            $dem++;
            }
        }
        ?>
    </div>

    <!-- Left and right controls -->
    <a class="carousel-control-prev" href="#banner" data-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </a>
    <a class="carousel-control-next" href="#banner" data-slide="next">
        <span class="carousel-control-next-icon"></span>
    </a>
</div>