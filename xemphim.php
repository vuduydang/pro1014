<?php 
    require_once './commons/constants.php';
    require_once './commons/db.php';
    require_once './commons/helpers.php';

    $url    = $_GET['url'];
    $select = "SELECT * FROM parts WHERE url = '$url'";
    $infoP  = executeQuery($select);

    $id     = $infoP['film_id'];
    $select = "SELECT * FROM films WHERE id = '$id'";
    $infoF  = executeQuery($select);

    $select = "SELECT * FROM parts WHERE film_id = '$id'";
    $listP  = executeQuery($select, true);

    //tang views
    $views      = $infoF['views']+1;
    $insert     = "UPDATE films SET views = '$views' WHERE id = '$id'";
    executeQuery($insert);
    $views      = $infoP['views']+1;
    $insert     = "UPDATE parts SET views = '$views' WHERE url = '$url'";
    executeQuery($insert);

    $sqlQuery   = "SELECT * FROM reviews WHERE film_id = '$id' ORDER BY id DESC";
    $reviews    = executeQuery($sqlQuery, true);

?>
<!DOCTYPE html>
<html lang="vi">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
	<title><?=$infoP['name']?></title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
    <meta name="_token" id="token" value="">
    <meta name="_socket" id="socket" value="6001">

	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta http-equiv="cache-control" content="max-age=0" />
	<meta http-equiv="cache-control" content="no-cache" />
	<meta name="robots" content="index, follow" />
	<meta name="language" content="Vietnamese, English" />
	
    <link rel="shortcut icon" href="./assets/ico.png" type="image/png" />

	<meta name="description" content="Doraemon Tập 1 - Tập đặc biệt: Ao cá trong phòng học &amp; Cỗ máy thời gian đâu mất rồi &amp; Nhớ lại! ấn tượng ngày đầu tiên" />
	<meta name="keywords" content="doraemon,doraemon tap 1" />

	<!-- Facebook Metadata /-->
	<meta property="fb:app_id" content="362811147450608" />
	<!-- <meta property="og:image" content="../i.imacdn.com/vg/2015/06/doraemon-tap-1-1435118450.jpg" /> -->
	<!-- <meta property="og:url" content="doraemon.php" /> -->
	<meta property="og:description" content="Doraemon Tập 1 - Tập đặc biệt: Ao cá trong phòng học &amp; Cỗ máy thời gian đâu mất rồi &amp; Nhớ lại! ấn tượng ngày đầu tiên" />
	<meta property="og:title" content="Doraemon Tập 1 - Tập đặc biệt: Ao cá trong phòng học &amp; Cỗ máy thời gian đâu mất rồi &amp; Nhớ lại! ấn tượng ngày đầu tiên" />
	<meta property="og:site_name" content="ClipAnime" />
	<!-- <meta property="og:type" content="video.php" /> -->

	<!-- Google+ Metadata /-->
	<meta itemprop="name" content="Doraemon Tập 1 - Tập đặc biệt: Ao cá trong phòng học &amp; Cỗ máy thời gian đâu mất rồi &amp; Nhớ lại! ấn tượng ngày đầu tiên" />
	<meta itemprop="description" content="Doraemon Tập 1 - Tập đặc biệt: Ao cá trong phòng học &amp; Cỗ máy thời gian đâu mất rồi &amp; Nhớ lại! ấn tượng ngày đầu tiên" />
	<!-- <meta itemprop="image" content="../i.imacdn.com/vg/2015/06/doraemon-tap-1-1435118450.jpg" /> -->
    <link rel="stylesheet" type="text/css" href="./public/css/video-js.css">
			<!-- Google webmaster tools verification -->
		<meta name="google-site-verification" content="X6wTJolQe36XUJJeyIxqPMs9YJ0dqJXfDdy1yksGNhA" />
		<!-- Bing verification -->
		<meta name="msvalidate.01" content="C21FDE84CE65ABA807746F89A0D2964C" />
	
        <link rel="stylesheet" href="./public/css/film99f8.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">



    </head>
<body>

    <?php include_once"./_share/header.php"; ?>

    <div class="container" data-id="01" data-episode-id="<?=$infoP['id']?>"
         data-type="" data-is-upcoming="" data-copyrighted=""
         
         data-name="Doraemon" data-episode-min="1" data-episode-max="505">
	<div class="clearfix"></div>
        

        <div class="player-wrapper">
            <div id="playerYF" class="player" style="display: none;"></div>
            <div id="player" class="player">
                <video id="my-video" class="video-js" controls preload="auto" poster="./assets/img/video-bg.jpg" data-setup="{}" style="width: 100%; height: 100%">
                    <source id="source" src="./videos/<?=$infoP['player']?>" type='video/mp4'>
                    <p class="vjs-no-js">Bạn phải bật javascript để xem video này, và nâng cấp trình duyệt <a href="http://videojs.com/html5-video-support/" target="_blank">hỗ trợ HTML5 video</a></p>
                </video>
                <script type="text/javascript" src="./public/js/video.js"></script>
            </div>
            
        </div>
        <div class="player-meta">
        </div>
        
        
        
        <div class="film-related video" style="margin-top: -16px;">
            <hr>
            <h3 class="dsp">Danh sách tập</h3>
            <?php foreach ($listP as  $value) : ?>
                <div class="film-related-item">
                    <div class="film-related-thumbnail">
                        <a href="xemphim.php?url=<?=$value['url']?>">
                            <video class="video-item-thumbnail" src="./videos/<?=$value['player']?>#t=5"></video>
                        </a>
                    </div>
                    <div class="film-related-meta">
                        <a href="xemphim.php?url=<?=$value['url']?>">
                            <div class="film-related-title"><?php echo $value['name'] ?></div>
                        </a>
                        <div class="film-related-views">Lượt xem : <?php echo $value['views']?></div>
                    </div>
                </div>
            <?php endforeach ?>
            <hr>
            <div id="ads" class="ads-1">
                <a href="https://vnfbs.com/affiliate?ppu=13048905" target="_blank" style="outline: none"><img src="https://vnfbs.com/upload/promo/banner/db63828d70170fb721bab46631ac63a6.gif?ppu=13048905" width="340" height="320" border="0"></a>
            </div>
        </div>

        <div class="clearfix"></div>
        <div class="controller">
            <div>
                <span class="controller-icon" name="ctr-adsb" style="color: #370080"><i class="fas fa-shield-alt"></i></span>
                <span class="controller-name">Ads Block</span>
            </div>
            <div>
                <span class="controller-icon" name="ctr-pause" style="color:green"><i class="fas fa-toggle-off"></i></span>
                <span class="controller-name">Tự động pause</span>
            </div>
        </div>
        
        <!-- INFO -->

        <div class="film-info"><hr>
            <div class="film-info-subteam">
                <div class="film-related-title"><h3><?=$infoP['name']?></h3></div>
            </div>
            <hr>
            <div class="film-info-description">
                <h4><i class="fas fa-film"></i> VuiGhe Sub</h4><br>
                <h5>Mô Tả</h5>
                    <?=$infoF['content']?>
            </div>
            <hr>
            <div id="ads" class="ads-2">
                <a href="https://vnfbs.com/promo/100DepositBonus?ppu=13048905" target="_blank" style="outline: none"><img src="https://vnfbs.com/upload/promo/banner/3dc409a3eddaeeb0171cfd7447a2b52a.gif?ppu=13048905" width="880" height="120" border="0"></a>
            </div>
            <!-- BÌNH LUẬN -->
            <div class="player-sidebar-body body-comment hidde">
                <h3><i class="fas fa-film"></i> BÌNH LUẬN PHIM</h3>
                <div class="comment-input">
                    <input type="hidden" name="id" value="<?=$id?>" id="id_film">
                    <input type="text" name="comment-input" value="" id="comment-input">
                    <span id="comment-emoticon" class="comment-emoticon icon-smile"></span>
                    <div id="emoji-picker" class="emoji-picker hidden">
                        <div class="emoji-picker-header">
                            <div class="emoji-picker-type" data-tab="panda"><img src="assets/img/panda.gif"></div>
                            <div class="emoji-picker-type" data-tab="onion"><img src="assets/img/onion.gif"></div>
                            <div class="emoji-close"><i class="icon-close"></i></div>
                        </div>
                        <div class="emoji-picker-body">
                            <ul class="emoji-list emoji-panda" data-tab="panda"></ul>
                            <ul class="emoji-list emoji-onion hidden" data-tab="onion"></ul>
                        </div>
                    </div>
                </div>
                <div class="comment-list">
                    <?php foreach ($reviews as $value) : 
                            $id   = $value['user_id'];
                            $user = executeQuery("SELECT * FROM users WHERE id = '$id'");
                    ?>
                    <div data-id="981415" class="comment-item">
                        <div class="author-avatar"><img src="./assets/avatars/<?=$user['avatar']?>"></div>
                        <div class="comment-item-body">
                            <div class="author-name"><?=$user['name']?></div>
                            <div class="comment-content"><?=$value['content']?></div>
                            <div class="comment-action">
                                <!-- <span class="comment-reply"><i class="icon icon-comment"></i> trả lời</span> -->
                                <span class="comment-time"><i class="icon icon-time"></i> <?=$value['date']?></span>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
                    <input type="button" class="comment-more hidden" value="Xem thêm">
                    <input type="text" name="reply-input" id="reply-input" class="reply-input hidden">
                </div>
                <!-- <div class="loading"></div> -->
            </div>
        </div>
    </div>

    <div class="floating-action">
	<div class="action-item action-toggle"><i class="icon-up"></i></div>
	
</div>    

        
        
    <script type="text/javascript" src="./public/js/vlib581a.js"></script>
        
    <script type="text/javascript" src="./public/js/enginee614.js"></script>
    <script type="text/javascript" src="./public/js/bfilms.js"></script>


    		<!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-81129102-2"></script>
        <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());

          gtag('config', 'UA-81129102-2');
        </script>

    <!-- push link video -->
    <script type="text/javascript" src="./public/js/main.js"></script>
    <script type="text/javascript" src="./public/js/control-player.js"></script>
    
	<!-- <script type="text/javascript">
        $(document).ready(function(){
            setTimeout(function(){
                if ("<?=$infoP['player']?>" != "") {
                    $(".player-video").attr("src","./videos/<?=$infoP['player']?>"+"#t=0.1");
                }else{
                    $(".player-video").attr("src","./videos/error.mp4"+"#t=0.1");
                }
                
            }, 1500);
        });
    </script> -->
      	
</body>

</html>