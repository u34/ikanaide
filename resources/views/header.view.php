<header>
    <div class="inner-header">
        <a href="/"><p id="header-logo">ikanaide</p></a>
        <ul class="header-links">
            <?php
                $nav = ['home', 'anime', 'manga', 'rankings', 'community'];
                for ($i=0; $i < count($nav); $i++) {
                    if ($nav[$i] === substr($page, 1, strlen($page))) {
                        print "<a href='/".$nav[$i]."'><li class='current'>$nav[$i]</li></a>";
                    } else {
                        print "<a href='/".$nav[$i]."'><li>$nav[$i]</li></a>";
                    }
                }
            ?>
        </ul>
        <div class="header-user">
            <?php
            if (isset($_SESSION['loggedin'])) {
                ?>
                <img src="/storage/testing/1.png" alt="">
                <?php
            } else {
                ?>
                <ul class="header-user-ul">
                    <li>Sign in</li>
                    <li>Sign up</li>
                </ul>
                <?php
            }
            ?>
        </div>
    </div>
</header>