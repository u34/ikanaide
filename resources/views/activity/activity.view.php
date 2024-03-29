<div class="activity_single-page_wrapper">
<?php 
    
    if (isset($repliedPost)) {
        ?>

    <section class="replied-posts posts-wrapper box-wrapper" onclick="window.location='/activity/<?=$repliedPost['post']['post_id']?>'">
            <div class="post-entry box-wrapper box-body">
                <div class="top">
                    <a href="/<?=$repliedPost['user']['username']?>"><img src="<?=$repliedPost['user']['pfp']?>" alt=""></a>
                    <div class="post-info">
                        <div class="post-info_user">
                            <div class="username">
                                <div><span><?=$repliedPost['user']['username']?></span><span class="post_time-ago">&nbsp;&nbsp;·&nbsp;&nbsp;<?=$repliedPost['post']['time_ago']?></span></div>
                                <div><span class="material-icons dots">more_horiz</span></div>
                            </div>
                        </div>
                        <div class="post-info_relation">
                            <?php
                            
                            if (isset($repliedPost['post']['replying_to'], $repliedPost['post']['medium_id'])) {
                                ?><span class="low-opacity">replying to </span><a class="post-relation_link" href="/<?=$repliedPost['post']['replying_to']?>"><?=$repliedPost['post']['replying_to']?></a> <span class="low-opacity">on</span> <a class="post-relation_link" href="/<?=$repliedPost['post']['medium']?>/<?=str_replace(' ', '-', $repliedPost['post']['medium_title'])?>"><?=$repliedPost['post']['medium_title']?></a><?php
                            } else if (isset($repliedPost['post']['medium_id'])) {
                                ?><span class="low-opacity">on </span><a class="post-relation_link" href="/<?=$repliedPost['post']['medium']?>/<?=str_replace(' ', '-', $repliedPost['post']['medium_title'])?>"><?=$repliedPost['post']['medium_title']?></a><?php
                            } else if (isset($repliedPost['post']['replying_to'])) {
                                ?><span class="low-opacity">replying to </span><a class="post-relation_link" href="/<?=$repliedPost['post']['replying_to']?>"><?=$repliedPost['post']['replying_to']?></a><?php
                            }

                            ?>
                        </div>
                    </div>
                </div>
                <div class="bottom">
                    <div class="content"><?=htmlspecialchars($repliedPost['post']['content'])?></div>
                    <div class="social">
                        <div class="social-icon">
                            <span class="material-icons-outlined">chat_bubble_outline</span>
                            <p><?=$repliedPost['post']['reply_count']?></p>
                        </div>
                        <div class="social-icon">
                        <span class="material-icons-outlined">
                            <?php if (isset($repliedPost['user']['liked']) && $repliedPost['user']['liked']) {echo "favorite";} else {echo "favorite_border";} ?>
                        </span>
                            <p><?=$repliedPost['post']['like_count']?></p>
                        </div>
                        
                        <div class="social-icon">
                            <span class="material-icons-outlined">
                                <?php if (isset($repliedPost['user']['bookmarked']) && $repliedPost['user']['bookmarked']) {echo "bookmark";} else {echo "bookmark_border";} ?>
                            </span>
                            <p><?=$repliedPost['post']['bookmark_count']?></p>
                        </div>
                    </div>
                    </div>
                
                </div>

    </section>
    <hr class="activity_replied-reply_separator">
    <?php
    }
    ?>

    <section class="posts-wrapper box-wrapper">
        <div class="post-entry single-page box-wrapper box-body">
            <div class="top">
                <a href="/<?=$post['user']['username']?>"><img src="<?=$post['user']['pfp']?>" alt=""></a>
                <div class="post-info">
                    <div class="post-info_user">
                        <div class="username">
                            <div><span><?=$post['user']['username']?></span><span class="post_time-ago">&nbsp;&nbsp;·&nbsp;&nbsp;<?=$post['post']['time_ago']?></span></div>
                            <div class="display-settings">
                                <div class="post-settings" id="post_settings">
                                    <ul>
                                        <?php
                                        
                                        if (isset($_COOKIE['user_id']) && $_COOKIE['user_id'] == $post['user']['user_id']) {
                                        ?><a href="/delete?id=<?=$post['post']['post_id']?>"><li>Delete</li></a><?php
                                        } else if (!isset($_COOKIE['session'])) {
                                            ?><a href="/login"><li>Report</li></a><?php
                                        } else {
                                            ?><a href=""><li>Report</li></a><?php
                                        }
                                        
                                        ?>
                                        
                                    </ul>
                                </div>
                                <span class="material-icons dots" id="display_settings">more_horiz</span>
                            </div>
                        </div>
                    </div>
                    <div class="post-info_relation">
                        <?php

                        if (isset($post['post']['replying_to'], $post['post']['medium_id'])) {
                            ?><span class="low-opacity">replying to </span><a class="post-relation_link" href="/<?=$post['post']['replying_to']?>"><?=$post['post']['replying_to']?></a> <span class="low-opacity">on</span> <a class="post-relation_link" href="/<?=$post['post']['medium']?>/<?=str_replace(' ', '-', $post['post']['medium_title'])?>"><?=$post['post']['medium_title']?></a><?php
                        } else if (isset($post['post']['medium_id'])) {
                            ?><span class="low-opacity">on </span><a class="post-relation_link" href="/<?=$post['post']['medium']?>/<?=str_replace(' ', '-', $post['post']['medium_title'])?>"><?=$post['post']['medium_title']?></a><?php
                        } else if (isset($post['post']['replying_to'])) {
                            ?><span class="low-opacity">replying to </span><a class="post-relation_link" href="/<?=$post['post']['replying_to']?>"><?=$post['post']['replying_to']?></a><?php
                        }

                        ?>
                    </div>
                </div>
            </div>
            <div class="bottom">
                <div class="content"><?=htmlspecialchars($post['post']['content'])?></div>
                <div class="date low-opacity">
                    <?=timeFormat(substr($post['post']['date'], 10, 6))?>&nbsp;&nbsp;·&nbsp;&nbsp;<?=ucfirst(dateFormat(substr($post['post']['date'], 0, 10)))?>
                </div>
                
                <hr id="edit-list_fields-separator">
                <div class="social">
                    <div class="social-icon activity-page_icon" id="display-reply">
                        <span class="material-icons-outlined" id="reply-icon">chat_bubble_outline</span>
                        <p><?=$post['post']['reply_count']?></p>
                    </div>
                    <a href="/like?id=<?=$post['post']['post_id']?>">
                        <div class="social-icon activity-page_icon">
                        <span class="material-icons-outlined">
                            <?php if (isset($post['user']['liked']) && $post['user']['liked']) {echo "favorite";} else {echo "favorite_border";} ?>
                        </span>
                            <p><?=$post['post']['like_count']?></p>
                        </div>
                    </a>
                    
                    <a href="/bookmark?id=<?=$post['post']['post_id']?>">
                        <div class="social-icon activity-page_icon">
                            <span class="material-icons-outlined">
                                <?php if (isset($post['user']['bookmarked']) && $post['user']['bookmarked']) {echo "bookmark";} else {echo "bookmark_border";} ?>
                            </span>
                            <p><?=$post['post']['bookmark_count']?></p>
                        </div>
                    </a>
                    
                </div>
                
            </div>

        </div>
    </section>

    <?php

    if (isset($_COOKIE['session'])) {
    ?>

    <section class="post-reply_wrapper box-wrapper" id="post-reply_wrapper">
        <form method="POST" action="<?=$page?>">
            <div class="top">
                <img src="<?=$loggedUser['pfp']?>" alt="">
                <textarea name="post-reply" id="post-reply" placeholder="Post your reply"></textarea>
            </div>
            <div class="bottom">
                <button type="button" id="cancel-reply" class="box submit-button__colorful">Cancel</button>
                <input class="box submit-button__colorful" type="submit" name="submit-reply" value="Reply">
            </div>
        </form>
    </section>

    <?php
    }

    ?>

    <?php 
    
    if (isset($replies)) {
        ?>

    <section class="posts-wrapper box-wrapper">
        <?php

        foreach ($replies as $reply) {
            ?>

            
                <div class="post-entry box-wrapper box-body" onclick="window.location='/activity/<?=$reply['post']['post_id']?>'">
                    <div class="top">
                        <a href="/<?=$reply['user']['username']?>"><img src="<?=$reply['user']['pfp']?>" alt=""></a>
                        <div class="post-info">
                            <div class="post-info_user">
                                <div class="username">
                                    <div><span><?=$reply['user']['username']?></span><span class="post_time-ago">&nbsp;&nbsp;·&nbsp;&nbsp;<?=$reply['post']['time_ago']?></span></div>
                                    <div><span class="material-icons dots">more_horiz</span></div>
                                </div>
                            </div>
                            <div class="post-info_relation">
                                <?php

                                if (isset($reply['post']['replying_to'], $reply['post']['medium_id'])) {
                                    ?><span class="low-opacity">replying to </span><a class="post-relation_link" href="/<?=$reply['post']['replying_to']?>"><?=$reply['post']['replying_to']?></a> <span class="low-opacity">on</span> <a class="post-relation_link" href="/<?=$reply['post']['medium']?>/<?=str_replace(' ', '-', $reply['post']['medium_title'])?>"><?=$reply['post']['medium_title']?></a><?php
                                } else if (isset($reply['post']['medium_id'])) {
                                    ?><span class="low-opacity">on </span><a class="post-relation_link" href="/<?=$reply['post']['medium']?>/<?=str_replace(' ', '-', $reply['post']['medium_title'])?>"><?=$reply['post']['medium_title']?></a><?php
                                } else if (isset($reply['post']['replying_to'])) {
                                    ?><span class="low-opacity">replying to </span><a class="post-relation_link" href="/<?=$reply['post']['replying_to']?>"><?=$reply['post']['replying_to']?></a><?php
                                }
                                

                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="bottom">
                        <div class="content"><?=htmlspecialchars($reply['post']['content'])?></div>
                        <div class="social">
                            <div class="social-icon">
                                <span class="material-icons-outlined" id="display-reply">chat_bubble_outline</span>
                                <p><?=$reply['post']['reply_count']?></p>
                            </div>
                            <div class="social-icon">
                            <span class="material-icons-outlined">
                                <?php if (isset($reply['user']['liked']) && $reply['user']['liked']) {echo "favorite";} else {echo "favorite_border";} ?>
                            </span>
                                <p><?=$reply['post']['like_count']?></p>
                            </div>
                            
                            <div class="social-icon">
                                <span class="material-icons-outlined">
                                    <?php if (isset($reply['user']['bookmarked']) && $reply['user']['bookmarked']) {echo "bookmark";} else {echo "bookmark_border";} ?>
                                </span>
                                <p><?=$reply['post']['bookmark_count']?></p>
                            </div>
                        </div>
                        </div>
                    
                    </div>
                

                <?php
            }
        ?>
    </section>
        <?php
        }
    ?>           

</div>

<script !src="">
    let wrapper = document.getElementById('post-reply_wrapper');
    let btn = document.getElementById('display-reply');
    let icon = document.getElementById('reply-icon');
    let cancelBtn = document.getElementById('cancel-reply');

    let settings = document.getElementById('display_settings');
    let menu = document.getElementById('post_settings');

    btn.addEventListener('click', function() {
        wrapper.style.display = "block";
        document.getElementById("post-reply").focus();
        icon.style.opacity = "1";
    });

    cancelBtn.addEventListener('click', function() {
        wrapper.style.display = "none";
        icon.style.opacity = "var(--font_low-opacity)";
    });

    settings.addEventListener('click', function() {
        if (menu.style.display === "block") {
            menu.style.display = "none";
        } else {
            menu.style.display = "block";
        }
    })

</script>