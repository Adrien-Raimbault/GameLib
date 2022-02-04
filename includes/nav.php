<header>
    <nav>
        <ul>
            <li><a href="index.php?page=home">Home</a></li>
            <li><a href="index.php?page=news">News</a></li>
            <li><a href="index.php?page=contact">Contact</a></li>
            <?php
                if(isset($_SESSION['login']) && $_SESSION['login'] === true)
                echo "<li class=\"logout\"><a href=\"index.php?page=logout\">Logout</a></li>";
                
                else echo "<li class=\"login\"><a href=\"index.php?page=login\">Login</a></li>"
            ?>
        </ul>
    </nav>
    <?php
    if(isset($_SESSION['login']) && $_SESSION['login'] === true) {
        $nom = $_SESSION['nom'];
        $prenom = $_SESSION['prenom'];
        echo "<p>Hello $nom $prenom</p>";
    }
    else echo "<p>Y'a quelqun ???</p>";
    ?>
</header>